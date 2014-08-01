<?php /* Smarty version 2.6.26, created on 2012-05-19 17:46:26
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/bulkdomaintransfer.tpl */ ?>
<?php if ($this->_tpl_vars['bulkdomainsearchenabled']): ?>
<p align="center"><a href="domainchecker.php"><?php echo $this->_tpl_vars['LANG']['domainsimplesearch']; ?>
</a> | <a href="domainchecker.php?search=bulkregister"><?php echo $this->_tpl_vars['LANG']['domainbulksearch']; ?>
</a> | <strong><?php echo $this->_tpl_vars['LANG']['domainbulktransfersearch']; ?>
</strong></p>
<?php endif; ?>
<p><?php echo $this->_tpl_vars['LANG']['domainbulktransferdescription']; ?>
</p>
<form method="post" action="domainchecker.php?search=bulktransfer">
  <div class="contentbox" align="center">
    <p align="center">
      <textarea name="bulkdomains" cols="60" rows="8"><?php echo $this->_tpl_vars['bulkdomains']; ?>
</textarea>
      <br />
      <br />
      <?php if ($this->_tpl_vars['inccode']): ?><font color="#cc0000"><strong><?php echo $this->_tpl_vars['LANG']['imagecheck']; ?>
</strong></font><br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['capatacha']): ?><img src="includes/verifyimage.php" alt="Verify Image" border="0" class="absmiddle" />
      <input type="text" name="code" size="10" maxlength="5">
      &nbsp;&nbsp;&nbsp; <?php endif; ?>
      <input type="submit" id="Submit" value="<?php echo $this->_tpl_vars['LANG']['domainlookupbutton']; ?>
">
    </p>
  </div>
</form>
<br />
<?php if ($this->_tpl_vars['availabilityresults']): ?>
<h2><?php echo $this->_tpl_vars['LANG']['morechoices']; ?>
</h2>
<form method="post" action="<?php echo $this->_tpl_vars['systemsslurl']; ?>
cart.php?a=add&domain=transfer">
  <table width="100%" border="0" cellpadding="10" cellspacing="0" class="data">
    <tr>
      <th width="20"></th>
      <th><?php echo $this->_tpl_vars['LANG']['domainname']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['domainstatus']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['domainmoreinfo']; ?>
</th>
    </tr>
    <?php $_from = $this->_tpl_vars['availabilityresults']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['result']):
?>
    <tr>
      <td><?php if ($this->_tpl_vars['result']['status'] == 'unavailable'): ?>
        <input type="checkbox" name="domains[]" value="<?php echo $this->_tpl_vars['result']['domain']; ?>
" />
        <input type="hidden" name="domainsregperiod[<?php echo $this->_tpl_vars['result']['domain']; ?>
]" value="<?php echo $this->_tpl_vars['result']['period']; ?>
" />
        <?php else: ?>X<?php endif; ?></td>
      <td><?php echo $this->_tpl_vars['result']['domain']; ?>
</td>
      <td class="<?php if ($this->_tpl_vars['result']['status'] == 'unavailable'): ?>textgreen<?php else: ?>textred<?php endif; ?>"><?php if ($this->_tpl_vars['result']['status'] == 'unavailable'): ?><?php echo $this->_tpl_vars['LANG']['domainavailable']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['domainunavailable']; ?>
<?php endif; ?></td>
      <td><?php if ($this->_tpl_vars['result']['status'] == 'unavailable'): ?>
        <select name="domainsregperiod[<?php echo $this->_tpl_vars['result']['domain']; ?>
]">
          <?php $_from = $this->_tpl_vars['result']['regoptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['period'] => $this->_tpl_vars['regoption']):
?>
          <?php if ($this->_tpl_vars['regoption']['transfer']): ?><option value="<?php echo $this->_tpl_vars['period']; ?>
"><?php echo $this->_tpl_vars['period']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
 @ <?php echo $this->_tpl_vars['regoption']['transfer']; ?>
</option><?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        </select>
        <?php endif; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['ordernowbutton']; ?>
 >>" />
  </p>
</form>
<?php else: ?>
<h2><?php echo $this->_tpl_vars['LANG']['domainspricing']; ?>
</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <th><?php echo $this->_tpl_vars['LANG']['domaintld']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['domainminyears']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['domainsregister']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['domainstransfer']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['domainsrenew']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['tldpricelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['tldpricelist']):
?>
  <tr>
    <td><?php echo $this->_tpl_vars['tldpricelist']['tld']; ?>
</td>
    <td><?php echo $this->_tpl_vars['tldpricelist']['period']; ?>
</td>
    <td><?php if ($this->_tpl_vars['tldpricelist']['register']): ?><?php echo $this->_tpl_vars['tldpricelist']['register']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['domainregnotavailable']; ?>
<?php endif; ?></td>
    <td><?php if ($this->_tpl_vars['tldpricelist']['transfer']): ?><?php echo $this->_tpl_vars['tldpricelist']['transfer']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['domainregnotavailable']; ?>
<?php endif; ?></td>
    <td><?php if ($this->_tpl_vars['tldpricelist']['renew']): ?><?php echo $this->_tpl_vars['tldpricelist']['renew']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['domainregnotavailable']; ?>
<?php endif; ?></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?><br />