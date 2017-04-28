<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">礼物匹配道具规则信息</a></li>
  </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="" autocomplete="off">
        <label>平台</label>
        <select id="website_id" name="website_id" class="input-xlarge">
          <{html_options options=$website_id_list selected=$data.website_id}>
        </select>
        <label>礼物类型名称</label>
        <select id="gift_type" name="gift_type" class="input-xlarge">
          <{html_options options=$gift_type_id_list selected=$data.gift_type}>
        </select>
        <label>礼物数量</label>
        <input id="gift_amount" type="text" name="gift_amount" value="<{$data.gift_amount}>" class="input-xlarge" required="true">
        <label>对应道具名</label>
        <select id="map_tool_name" name="map_tool_name" class="input-xlarge">
          <{html_options options=$item_id_list selected=$data.map_tool_name}>
        </select>
        <label>道具单价</label>
        <input id="tool_cost" type="text" name="tool_cost" value="<{$data.tool_cost}>" class="input-xlarge" required="true">
        <div class="btn-toolbar">
          <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(function(){
  var updateGiftType = function(websiteId){
    $.get("/api/gift_type.php", {
      website_id: websiteId
    }, function(data){
      data = JSON.parse(data);
      console.log(data);
      var html = '';
      for (i in data){
        html += '<option value="'+i+'">'+data[i]+'</option>';
      }
      console.log(html);
      $('#gift_type').html(html);
    })
  }

  $('#website_id').change(function(){
    var obj = $(this);
    var val = obj.val();
    console.log(val);
    if(!!val) {
      updateGiftType(val);
    }
  });
})
</script>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
