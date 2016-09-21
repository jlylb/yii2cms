au BufNewFile *.* :Author
au BufWritePost *.* :call LastModifyTime()
com!  -nargs=* -bar  Author :call SetComment(<args>)|update
let g:load_author=0
if !exists("g:load_author")
    finish
endif    
let g:load_author=1
let g:co_author = "you are xxxx"
let g:co_email= "you@126.com"
let g:co_website= "http://www.126.com"
function! SetComment()
    echo &filetype
    let line1=getline('1G')
    if line1 =~ '^#!.\+'
        finish
    endif    
    if &filetype=="python"
        let sstr="#!/usr/bin/env python"
        call setline(1,sstr)
        normal o
    endif    
    call setline(line('.'),'#*_*coding:utf-8*_*')
    normal j
python <<EOF
import vim
import time
author_list=[ "# @"+x[3:]+": "+vim.eval("g:" + x) for x in vim.vars.keys() if x.startswith('co_')]
default_list = [ "# @" + x + ": " + time.strftime("%Y-%m-%d %H:%M:%S") for x in ['create_time','update_time']]
expand = vim.Function('expand')
filename = expand("%:t")
default_list.append("# @filename: " + filename)
author_list.extend(default_list)
author_str="\n".join(author_list)
vim.command("normal o")
vim.command("normal 78i#")
vim.command('let @-="'+author_str+'"')
vim.command("put -")
vim.command("normal o")
vim.command("normal 78i#")
vim.command("normal o")
EOF
endfunction

function! LastModifyTime()
    let save_cursor = getpos(".")
    let line_num =search('^#\s*@update_time:','',line(1))
    if line_num > 0
        let line = substitute(getline(line_num),'\d.\+',strftime("%c"),'')
        echo save_cursor
        call setline(line_num,line)
        echo getpos('.')
        call setpos(".",save_cursor)
    endif
endfunction

