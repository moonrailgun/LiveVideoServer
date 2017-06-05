<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">充值信息</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:120px">充值交易号</th>
        <th style="width:120px">主播</th>
        <th style="width:120px">工会</th>
        <th style="width:120px">平台</th>
        <th style="width:120px">充值时间</th>
        <th style="width:120px">充值方式</th>
        <th style="width:120px">充值虚拟币</th>
        <th style="width:120px">充值金额</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=data from=$data_list item=data}>
      <tr>
        <td><{$data.recharge_id}></td>
        <td><{$data.user_id}></td>
        <td><{$website_id_list[$data.website_id]}></td>
        <td><{$group_id_list[$data.group_id]}></td>
        <td><{$data.recharge_time}></td>
        <td><{$data.recharge_method}></td>
        <td><{$data.recharge_amount}></td>
        <td><{$data.recharge_rmb}></td>
      </tr>
      <{/foreach}>
    </tbody>
  </table>
  </div>
</div>

<!-- 操作的确认层，相当于javascript:confirm函数 -->
<{$osadmin_action_confirm}>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
