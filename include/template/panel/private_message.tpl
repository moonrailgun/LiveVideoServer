<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
  <a href="private_message_add.php" class="btn btn-primary"><i class="icon-plus"></i> 发布消息</a>
  <a data-toggle="collapse" data-target="#search"  href="#" title= "检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>

<{if $_GET.search }>
<div id="search" class="collapse in">
<{else }>
<div id="search" class="collapse out" >
<{/if }>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
  <input type="hidden" name="search" value="1" >
  <div style="float:left;margin-right:5px">
		<label>消息类型</label>
    <select id="message_type" name="message_type" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$message_type_list selected=$_GET.message_type}>
    </select>
    <label>消息发布时间</label>
    <input type="text" id="start_date" name="start_date" value="<{$_GET.start_date}>" placeholder="起始时间" >
    <input type="text" id="end_date" name="end_date" value="<{$_GET.end_date}>" placeholder="结束时间" >
    <div class="btn-toolbar" style="padding-top:0;padding-bottom:0;margin-bottom:0">
      <button type="submit" class="btn btn-primary">检索</button>
    </div>
	</div>
	<div style="clear:both;"></div>
  <script>
  $(function() {
  	var date=$("#start_date");
  	date.datepicker({dateFormat: "yy-mm-dd"});
  	date.datepicker("option", "firstDay", 1 );
  });
  $(function() {
  	var date=$( "#end_date" );
  	date.datepicker({dateFormat: "yy-mm-dd"});
  	date.datepicker("option", "firstDay", 1 );
  });
  </script>
</form>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">消息列表</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:80px">消息类型</th>
        <th style="width:220px">消息内容</th>
        <th style="width:80px">消息发送人</th>
        <th style="width:120px">发送时间</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=item from=$list item=item}>
      <tr>
        <td><{$message_type_list[$item.message_type]}></td>
        <td><{$item.message_content}></td>
        <td><{$item.message_sender}></td>
        <td><{$item.createdAt}></td>
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
