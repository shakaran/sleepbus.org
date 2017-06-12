#!/bin/bash
export PREFIX=$HOME/local
curl -O -L https://github.com/lavv17/lftp/archive/v4.7.7.tar.gz
tar xf v4.7.7.tar.gz
cd lftp-4.7.7
#ACLOCAL_FLAGS="-I /usr/share/aclocal/" \
#    LIBS="-lreadline -lncurses" \
#    PKG_CONFIG_PATH=$PREFIX/lib/pkgconfig \
#    --without-gnutls --disable-nls
./autogen.sh  
make -s install
echo 'finished installing lftp'
/lftp -v
which lftp

#--with-readline=$PREFIX
#--with-readline-lib=$PREFIX/lib
