#!/bin/bash

versions=()

while :; do
    case $1 in
        5.6|7.0|7.1|7.2|7.3)       # Takes an option argument; ensure it has been specified.
            versions+=($1)
            ;;
        *)               # Default case: No more options, so break out of the loop.
            break
    esac

    shift
done

if [ ${#versions[@]} == 0 ] 
then
    versions+=(7.3)
fi

if [[ -f /.dockerenv ]] || grep -Eq '(lxc|docker)' /proc/1/cgroup; then 
        # we do not need to restart a container with php multiversion
        php$version "$@"
    else 
    
        docker_path=$(command -v docker)
        if [ -z "$docker_path" ]; then
            # echo "docker not installed"
            echo $docker_path
            read -p "Do you want to install docker? " -n 1 -r
            # echo    # (optional) move to a new line
            if [[ $REPLY =~ ^[Yy]$ ]]
            then
                sudo apt-get install docker
            fi
        fi
        
        
        name=php-mv'_'$(pwd | sed "s|[^[:alpha:].-]|_|g")

        if [ -z "$(docker ps -l | grep $name)" ]; then
            # echo "Running new docker jclaveau/php-multiversion for $(pwd)"
            command="docker run \
                -d \
                --rm \
                --volume=$HOME:$HOME:rw \
                --volume=/etc/group:/etc/group:ro \
                --volume=/etc/passwd:/etc/passwd:ro \
                --volume=/etc/shadow:/etc/shadow:ro \
                --volume=/etc/sudoers.d:/etc/sudoers.d:ro \
                --name $name \
                --workdir $(pwd) \
                --volume $(pwd):$(pwd) \
                jclaveau/php-multiversion"
                
            $($command)
        fi
        
        # avoid https://stackoverflow.com/questions/43099116/error-the-input-device-is-not-a-tty
        test -t 1 && USE_TTY="-t" 

        for version in "${versions[@]}"; 
        do 
            echo "Docker: php$version $@"
            docker exec -i ${USE_TTY} \
                --user $(id -u):$(id -g) \
                $name php$version "$@"
                
        done
fi
