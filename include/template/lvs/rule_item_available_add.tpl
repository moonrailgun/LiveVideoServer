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
          <select id="website_id" name="website_id" class="input-xlarge" onchange="updateActorList()">
            <{html_options options=$website_id_list selected=$_POST.website_id}>
          </select>
          <label>主播</label>
          <select id="actor_id" name="actor_id" class="input-xlarge">
          </select>
          <label>设备状态</label>
          <select name="machine_status" class="input-xlarge">
            <{html_options options=$status_list selected=$_POST.machine_status}>
          </select>
          <label>道具</label>
          <select name="item_id" class="input-xlarge">
            <{html_options options=$item_id_list selected=$_POST.item_id}>
          </select>
          <label>道具状态</label>
          <select name="item_status" class="input-xlarge">
            <{html_options options=$status_list selected=$_POST.item_status}>
          </select>
          <div class="btn-toolbar">
          	<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
          	<div class="btn-group"></div>
          </div>
        </form>
      </div>
    </div>
</div>

<script>

var actorIdList = JSON.parse('<{$actor_id_list_json}>');

function updateActorList(){

  var websiteId = $('#website_id').val();
  var actorList = actorIdList[websiteId];
  $("#actor_id").empty();
  $.each(actorList, function(index, value, array) {
    $("#actor_id").append("<option value='"+index+"'>"+value+"</option>");
  });
}

updateActorList();
</script>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
