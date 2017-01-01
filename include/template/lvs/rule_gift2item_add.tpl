<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写规则信息</a></li>
    </ul>

	<div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" method="post" action="" autocomplete="off">
          <label>视频网站</label>
          <select id="website_id" name="website_id" class="input-xlarge">
            <{html_options options=$website_id_list selected=$_POST.website_id}>
          </select>
          <label>礼物类型</label>
          <input type="text" name="gift_type" value="<{$_POST.gift_type}>" class="input-xlarge" required="true" >
          <label>礼物数量</label>
          <input type="text" name="gift_amount" value="<{$_POST.gift_amount}>" class="input-xlarge" required="true" >
          <label>对应道具</label>
          <select id="item_id" name="item_id" class="input-xlarge">
            <{html_options options=$item_id_list selected=$_POST.item_id}>
          </select>
          <div class="btn-toolbar">
          	<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
          	<div class="btn-group"></div>
          </div>
        </form>
      </div>
    </div>
</div>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
