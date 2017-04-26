<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">采集规则</a></li>
  </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="" autocomplete="off">
        <label>平台</label>
        <select id="website_id" name="website_id" class="input-xlarge">
          <{html_options options=$website_id_list selected=$rule_data.website_id}>
        </select>
        <label>玩家ID查询字段</label>
        <input id="user_id_field" type="text" name="user_id_field" value="<{$rule_data.user_id_field}>" class="input-xlarge" required="true">
        <label>玩家昵称查询字段</label>
        <input id="user_name_field" type="text" name="user_name_field" value="<{$rule_data.user_name_field}>" class="input-xlarge" required="true">
        <label>主播ID查询字段</label>
        <input id="actor_id_field" type="text" name="actor_id_field" value="<{$rule_data.actor_id_field}>" class="input-xlarge" required="true">
        <label>主播昵称查询字段</label>
        <input id="actor_name_field" type="text" name="actor_name_field" value="<{$rule_data.actor_name_field}>" class="input-xlarge" required="true">
        <label>礼物类型查询字段</label>
        <input id="gift_type_field" type="text" name="gift_type_field" value="<{$rule_data.gift_type_field}>" class="input-xlarge" required="true">
        <label>礼物数量查询字段</label>
        <input id="gift_amount_field" type="text" name="gift_amount_field" value="<{$rule_data.gift_amount_field}>" class="input-xlarge" required="true">
        <div class="btn-toolbar">
          <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
