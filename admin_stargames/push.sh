#!/bin/sh
# shell script to push git into branch
dirname="$(pwd)"
date=$(date '+%Y-%m-%d, %H:%M:%S')
clear >$(tty)
echo "AutoPushGit v.1.0, scripting by Feri :)"
echo "======================================="
echo "Git direktory: $dirname"
echo "Push ke branch: feri"
if [ -d .git ]; then
      read -p "Keterangan push: "  keterangan
      echo "Proses push ke branch feri, mohon tunggu....."
      git add .
      git commit -m "[$date] $keterangan"
      git push origin feri
      clear >$(tty)
      echo "AutoPushGit v.1.0, scripting by Feri :)"
      echo "======================================="
      echo "Proses push ke branch feri berhasil, perbarui source di git_btn, mohon tunggu....."
      cd ../..
      cd git_btn/poin-serbu-cms
      git pull origin feri
      git pull origin maliki
      git push origin master
      cd ../..
      cd git_feri/poin-serbu-cms
      git pull origin master
      echo "Proses selesai....."
else
   echo "$dirname bukan folder git!"
fi;