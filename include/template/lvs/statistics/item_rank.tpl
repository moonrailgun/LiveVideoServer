<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a data-toggle="collapse" data-target="#search" href="#" title="检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>

<{if $_GET.search }>
<div id="search" class="collapse in">
<{else }>
<div id="search" class="collapse out" >
<{/if }>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
  <input type="hidden" name="search" value="1" >
	<div style="float:left;margin-right:5px">
    <label>平台</label>
    <select id="website_id" name="website_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$website_id_list selected=$_GET.website_id}>
    </select>
    <label>排名条件</label>
    <select id="sort_by" name="sort_by" class="input-xlarge" selected="<{$_GET.sort_by}>">
      <option value="totalCost">虚拟币</option>
      <option value="totalAmount">次数</option>
    </select>
    <label>起止日期</label>
    <input type="text" id="start_date" name="start_date" value="<{$_GET.start_date}>" placeholder="起始时间" >
    <input type="text" id="end_date" name="end_date" value="<{$_GET.end_date}>" placeholder="结束时间" >
    <div class="btn-toolbar" style="padding-top:0;padding-bottom:0;margin-bottom:0">
      <button type="submit" class="btn btn-primary">检索</button>
    </div>
  </div>
	<div style="clear:both;"></div>
</form>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">道具排名</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>名次</th>
        <th>道具名称</th>
        <th>虚拟币/次数</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=rank from=$rank_list item=data}>
      <tr>
        <td><{$smarty.foreach.rank.index + 1}></td>
        <td><{$data.toolName}></td>
        <td><{$data.totalCost}>/<{$data.totalAmount}></td>
      </tr>
      <{/foreach}>
    </tbody>
  </table>
  </div>
</div>

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

<!-- 操作的确认层，相当于javascript:confirm函数 -->
<{$osadmin_action_confirm}>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
