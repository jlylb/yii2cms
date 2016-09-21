"_*_coding:utf-8_*_
function! Foo()
python << EOF
class Foo_demo:
    def __init__(self):
        print 'Foo_demo init'
Foo_demo()
EOF
endfunction
function! ShowInfo()
python <<EOF
import vim
for b in vim.current.buffer:
    print b
print vim.current.range
EOF
endfunction
function! ShowContent() range
    echo a:firstline
    echo a:lastline
python <<EOF
import vim
b = vim.current.buffer
fline = int(vim.eval("a:firstline"))
lline = int(vim.eval("a:lastline"))
select_buf=b[fline-1:lline]
lines=[];
for x in select_buf:
    lines.append(x.strip(',;').split(','))
#print lines
col_len=len(lines[0])
for i in range(col_len):
    columns=[];
    for line in lines:
        columns.append(len(line[i]))
    max_len=max(columns)
    for n,line in enumerate(lines):
        lines[n][i]=line[i].ljust(max_len)
for n,line in enumerate(lines):
    lines[n]=', '.join(line)

fstr=',\n'.join(lines)  
vim.command('normal "_'+str(lline-fline+1)+'dd')
vim.command('let @-="'+fstr+';"')
vim.command('normal k')
vim.command('put -')
#vim.command('call setline(41,'+fstr+')')



#print ','.join(lines)
EOF
endfunction
com! -range -nargs=*  MultiCon <line1>,<line2>call ShowContent(<args>)

function! Slines() range
    echo a:firstline
    echo a:lastline
endfunction
com! -range -nargs=0 Sline  <line1>,<line2>call Slines()
