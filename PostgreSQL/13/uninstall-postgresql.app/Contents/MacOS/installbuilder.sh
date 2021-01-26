#!/bin/sh

runtimes_dir=$(cd "$(dirname "${0}")" && pwd)
os_version=`uname -r`
machine_platform=`uname -p`
machine_arch=`uname -m`
if [ "${os_version:0:1}" == "6" ];then
    executable="none"
elif [ "${machine_platform}" == "i386" ];then

  if [ "${machine_arch}" == "x86_64" ]; then
    runtimes="osx-x86_64 osx-intel"
  else
    runtimes="osx-intel osx-x86_64"
  fi
  executable=none
  for r in ${runtimes} ; do
    if [ -f "${runtimes_dir}/${r}" ]; then
      executable=${r}
      break
    fi
  done

else
    executable="none"
fi

if [ "$executable" == "none" ]; then
    echo "The current OS X version is not supported"
    exit 1
fi
            
        
if [ "${1}" == --help ] || [ "`id -u 2>/dev/null`" == "0" ];then
    "`dirname \"${0}\"`/$executable" "$@"
else
    "`dirname \"${0}\"`/uninstall-postgresql" $executable "$@"
fi
                