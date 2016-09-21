#!/usr/bin/env python
#*_*coding:utf-8*_*
##############################################################################
# @email: you@126.com
# @author: you are xxxx
# @website: http://www.126.com
# @create_time: 2016-05-13 15:33:42
# @update_time: 2016/5/24 13:52:08
# filename: nnn.py
##############################################################################
def log(*name):
    def wrapper(func):
        def inner(*args,**kw):
            print "##############################################################################"
            res = func(*args,**kw)
            print "%s %s" % (res,name)
            print "##############################################################################"
        return inner
    return wrapper

@log
def ulog():
    return "2222222 [%s]" % __name__
#ulog()

letter=[chr(x) for x in range(65,91)]
letter1=[chr(x) for x in range(97,123)]
@log(*letter)
@log(*letter1)
#@log(*('a1','b1','c3'))
def uulog(*arg,**kw):
    return arg

list1=range(1,12)
uulog(*list1)
