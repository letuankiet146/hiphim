#!/bin/sh
# This is a comment!
echo '#############################'
cd tsfol
echo "open folder"

if [ -z "$(ls -A /home/vagrant/website/phim-data/tsfol)" ]; then
   echo "Empty"
   exit 1
else
   echo "Not Empty"
fi

# for oldname in *; do newname=`echo $oldname | sed -e 's/ //g'`; mv "$oldname" "$newname";
for file in *.ts
do
	#rename
	newNameExtTs=`echo $file | sed -e 's/[ ()]//g'`
	mv "$file" "$newNameExtTs"

	#convert
	newnameWithoutExt="$(echo "$newNameExtTs" | cut -f 1 -d '.')"	
	newNameExtMp4="${newnameWithoutExt}.mp4"
	ffmpeg -i $newNameExtTs -map 0 -c copy $newNameExtMp4
done
echo "DONE!!"