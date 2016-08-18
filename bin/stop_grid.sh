#!/bin/bash
echo "<pre>"
echo "Stopping Region Simulator ...."
screen -S Sim -X quit
sleep 3
echo "------------------------------"
sleep 1
echo "Stopping Grid Server ...."
screen -S Grid -X quit
sleep 3
echo "-------------------------"
sleep 1
echo "WhiteCore has been Stopped"
echo "</pre>"
