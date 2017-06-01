<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">充值折扣</a></li>
  </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="" autocomplete="off">
        <label>充值金额 <span class="label label-important">不能重复</span></label>
        <input id="recharge_amount" type="text" name="recharge_amount" value="<{$data.recharge_amount}>" class="input-xlarge" autofocus="true" required="true">
        <label>充值折扣</label>
        <input id="recharge_discount" type="text" name="recharge_discount" value="<{$data.recharge_discount}>" class="input-xlarge" autofocus="true" required="true">
        <div class="btn-toolbar">
          <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
