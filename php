#!/bin/bash

if [[ -f /.dockerenv ]] || grep -Eq '(lxc|docker)' /proc/1/cgroup; then 
        echo $(command -v docker)
        # exit;
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
        else
            # echo "docker installed"
            echo ""
        fi
fi

version=7.3

while :; do
    case $1 in
        5.6|7.0|7.1|7.2|7.3|7.4|latest)       # Takes an option argument; ensure it has been specified.
            version=$1
            ;;
        # -h|-\?|--help)
            # show_help    # Display a usage synopsis.
            # exit
            # ;;
        # -f|--file)       # Takes an option argument; ensure it has been specified.
            # if [ "$2" ]; then
                # file=$2
                # shift
            # else
                # die 'ERROR: "--file" requires a non-empty option argument.'
            # fi
            # ;;
        # --file=?*)
            # file=${1#*=} # Delete everything up to "=" and assign the remainder.
            # ;;
        # --file=)         # Handle the case of an empty --file=
            # die 'ERROR: "--file" requires a non-empty option argument.'
            # ;;
        # -v|--verbose)
            # verbose=$((verbose + 1))  # Each -v adds 1 to verbosity.
            # ;;
        # --)              # End of all options.
            # shift
            # break
            # ;;
        # -?*)
            # echo $1
            # printf 'WARN: Unknown option (ignored): %s\n' "$1" >&2
            # ;;
        *)               # Default case: No more options, so break out of the loop.
            break
    esac

    shift
done


# echo $version;
# echo "$@";    
# echo $1;

docker run -it --rm \
    --name php-multiversion \
    -v /var/run/docker.sock:/var/run/docker.sock \
    -v $(pwd):/usr/src/myapp \
    -w /usr/src/myapp \
    jclaveau/php-multiversion php$version "$@"

# docker run -it --rm \
    # --name my-php-test \
    # -v /var/run/docker.sock:/var/run/docker.sock \
    # -v $(pwd):/usr/src/myapp \
    # -w /usr/src/myapp \
    # jclaveau/php-multiversion lsb_release
