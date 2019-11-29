Describe "PHP"
  Describe "php"
    It "runs php in multiple versions"
      When run source ./php 5.6 7.0 7.3 spec/phpversion.php
      The line 1 of stdout should eq "Docker: php5.6 spec/phpversion.php"
      The line 2 of stdout should eq "5.6"
      The line 3 of stdout should eq "Docker: php7.0 spec/phpversion.php"
      The line 4 of stdout should eq "7.0"
      The line 5 of stdout should eq "Docker: php7.3 spec/phpversion.php"
      The line 6 of stdout should eq "7.3"
      The stderr should eq ""
    End
    It "runs php in default version (latest)"
      When run source ./php spec/phpversion.php
      The line 1 of stdout should eq "Docker: php7.3 spec/phpversion.php"
      The line 2 of stdout should eq "7.3"
      The stderr should eq ""
    End
    It "runs php in 5.6"
      When run source ./php 5.6 spec/phpversion.php
      The line 1 of stdout should eq "Docker: php5.6 spec/phpversion.php"
      The line 2 of stdout should eq "5.6"
      The stderr should eq ""
    End
    It "runs php in 7.0"
      When run source ./php 7.0 spec/phpversion.php
      The line 1 of stdout should eq "Docker: php7.0 spec/phpversion.php"
      The line 2 of stdout should eq "7.0"
      The stderr should eq ""
    End
    It "runs php in 7.1"
      When run source ./php 7.1 spec/phpversion.php
      The line 1 of stdout should eq "Docker: php7.1 spec/phpversion.php"
      The line 2 of stdout should eq "7.1"
      The stderr should eq ""
    End
    It "runs php in 7.2"
      When run source ./php 7.2 spec/phpversion.php
      The line 1 of stdout should eq "Docker: php7.2 spec/phpversion.php"
      The line 2 of stdout should eq "7.2"
      The stderr should eq ""
    End
    It "runs php in 7.3"
      When run source ./php 7.3 spec/phpversion.php
      The line 1 of stdout should eq "Docker: php7.3 spec/phpversion.php"
      The line 2 of stdout should eq "7.3"
      The stderr should eq ""
    End
    It "runs php in 7.4"
      When run source ./php 7.4 spec/phpversion.php
      The line 1 of stdout should eq "Docker: php7.3 7.4 spec/phpversion.php"
      The line 2 of stdout should eq "Could not open input file: 7.4"
      The status should eq 1
    End
  End
  
End
