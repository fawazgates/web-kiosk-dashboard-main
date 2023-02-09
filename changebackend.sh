#!/bin/bash
# check url
#for i in $(grep -iRl "api-ekiosk"| grep "php"); do cat $i | grep "api-ekiosk"; done
for i in $(grep -iRl "api-ekiosk"| grep "php"); do sed -i 's\https://api-ekiosk.bisaai.id:8081/ekiosk_dev\https://gate.bisaai.id:8080/ekiosk_prod\g' $i; done
