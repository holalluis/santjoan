#!/bin/bash
git commit -am "canvis" && git push && bash deploy/deploy.sh
bash ~/bin/reload-chrome.sh
