<?php /* Smarty version 2.6.26, created on 2012-05-22 21:28:13
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareadomains.tpl */ ?>
<h2><?php echo $this->_tpl_vars['LANG']['clientareanavdomains']; ?>
</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['numproducts']; ?>
 <?php echo $this->_tpl_vars['LANG']['recordsfound']; ?>
,  <?php echo $this->_tpl_vars['LANG']['page']; ?>
 <?php echo $this->_tpl_vars['pagenumber']; ?>
 <?php echo $this->_tpl_vars['LANG']['pageof']; ?>
 <?php echo $this->_tpl_vars['totalpages']; ?>
</td>
    <td align="right"><form method="post" action="clientarea.php?action=domains"><input type="text" name="q" value="<?php if ($this->_tpl_vars['q']): ?><?php echo $this->_tpl_vars['q']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['searchenterdomain']; ?>
<?php endif; ?>" class="searchinput" onfocus="if(this.value=='<?php echo $this->_tpl_vars['LANG']['searchenterdomain']; ?>
')this.value=''" /> <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['searchfilter']; ?>
" class="searchinput" /></form></td>
  </tr>
</table>
<br />
<table class="data" width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <th><a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&orderby=regdate"><?php echo $this->_tpl_vars['LANG']['clientareahostingregdate']; ?>
</a><?php if ($this->_tpl_vars['orderby'] == 'regdate'): ?> <img src="images/<?php echo $this->_tpl_vars['sort']; ?>
.gif" alt="" border="0" /><?php endif; ?></th>
    <th><a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&orderby=domain"><?php echo $this->_tpl_vars['LANG']['clientareahostingdomain']; ?>
</a><?php if ($this->_tpl_vars['orderby'] == 'domain'): ?> <img src="images/<?php echo $this->_tpl_vars['sort']; ?>
.gif" alt="" border="0" /><?php endif; ?></th>
    <th><a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&orderby=nextduedate"><?php echo $this->_tpl_vars['LANG']['clientareahostingnextduedate']; ?>
</a><?php if ($this->_tpl_vars['orderby'] == 'nextduedate'): ?> <img src="images/<?php echo $this->_tpl_vars['sort']; ?>
.gif" alt="" border="0" /><?php endif; ?></th>
    <th><a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&orderby=price"><?php echo $this->_tpl_vars['LANG']['orderprice']; ?>
</a><?php if ($this->_tpl_vars['orderby'] == 'price'): ?> <img src="images/<?php echo $this->_tpl_vars['sort']; ?>
.gif" alt="" border="0" /><?php endif; ?></th>
    <th width="20">&nbsp;</th>
  </tr>
  <?php $_from = $this->_tpl_vars['domains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['domain']):
?>
  <tr class="clientareatable<?php if ($this->_tpl_vars['domain']['status'] == 'expired'): ?>terminated<?php else: ?><?php echo $this->_tpl_vars['domain']['status']; ?>
<?php endif; ?>">
    <td><?php echo $this->_tpl_vars['domain']['registrationdate']; ?>
</td>
    <td><a href="http://<?php echo $this->_tpl_vars['domain']['domain']; ?>
" target="_blank"><?php echo $this->_tpl_vars['domain']['domain']; ?>
</a></td>
    <td><?php echo $this->_tpl_vars['domain']['nextduedate']; ?>
</td>
    <td><?php echo $this->_tpl_vars['domain']['amount']; ?>
</td>
    <td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domaindetails">
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['domain']['id']; ?>
">
        <input type="image" src="images/viewdetails.gif" alt="<?php echo $this->_tpl_vars['LANG']['clientareaviewdetails']; ?>
" />
    </form></td>
  </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="6"><?php echo $this->_tpl_vars['LANG']['norecordsfound']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
</table>
<br />
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><?php echo $this->_tpl_vars['LANG']['show']; ?>
: <a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&itemlimit=10">10</a> <a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&itemlimit=25">25</a> <a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&itemlimit=50">50</a> <a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&itemlimit=100">100</a> <a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&itemlimit=all"><?php echo $this->_tpl_vars['LANG']['all']; ?>
</a></td>
    <td align="right"><?php if ($this->_tpl_vars['prevpage']): ?><a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&amp;page=<?php echo $this->_tpl_vars['prevpage']; ?>
"><?php endif; ?>&laquo; <?php echo $this->_tpl_vars['LANG']['previouspage']; ?>
<?php if ($this->_tpl_vars['prevpage']): ?></a><?php endif; ?> &nbsp; <?php if ($this->_tpl_vars['nextpage']): ?><a href="clientarea.php?action=domains<?php if ($this->_tpl_vars['q']): ?>&q=<?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>&amp;page=<?php echo $this->_tpl_vars['nextpage']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['LANG']['nextpage']; ?>
 &raquo;<?php if ($this->_tpl_vars['nextpage']): ?></a><?php endif; ?></td>
  </tr>
</table>
<br />
<table border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="10" align="right" class="clientareatableactive">&nbsp;</td>
    <td><?php echo $this->_tpl_vars['LANG']['clientareaactive']; ?>
</td>
    <td width="10" align="right" class="clientareatablepending">&nbsp;</td>
    <td><?php echo $this->_tpl_vars['LANG']['clientareapending']; ?>
</td>
    <td width="10" align="right" class="clientareatableterminated">&nbsp;</td>
    <td><?php echo $this->_tpl_vars['LANG']['clientareaexpired']; ?>
</td>
  </tr>
</table><br />