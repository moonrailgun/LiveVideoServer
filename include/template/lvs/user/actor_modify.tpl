<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">主播资料</a></li>
  </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="" autocomplete="off">
        <label>平台名称</label>
        <select id="website_id" name="website_id" class="input-xlarge">
          <{html_options options=$website_id_list selected=$actor_data.website_id}>
        </select>
        <label>工会名称</label>
        <select id="group_id" name="group_id" class="input-xlarge">
          <{html_options options=$group_id_list selected=$actor_data.group_id}>
        </select>
        <label>姓名</label>
        <input id="real_name" type="text" name="real_name" value="<{$actor_data.real_name}>" class="input-xlarge" required="true">
        <label>性别</label>
        <select id="sex" name="sex" class="input-xlarge">
          <option value="女">女</option>
          <option value="男">男</option>
        </select>
        <label>直播ID</label>
        <input id="live_id" type="text" name="live_id" value="<{$actor_data.live_id}>" class="input-xlarge" required="true">
        <label>频道ID</label>
        <input id="channel_id" type="text" name="channel_id" value="<{$actor_data.channel_id}>" class="input-xlarge" required="true">
        <label>常驻地</label>
        <select id="province" name="province" class="input-xlarge">
          <option value="">===请选择省===</option>
          <{html_options values=$province_list output=$province_list selected=$actor_data.province}>
        </select>
        <select id="city" name="city" class="input-xlarge" selected=<{$actor_data.city}>>
          <option value="">===请选择市===</option>
        </select>
        <label>备注</label>
        <textarea name="remark" rows="3" class="input-xlarge"><{$actor_data.remark}></textarea>
        <div class="btn-toolbar">
          <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(function(){
  var updateCity = function(province){
    $.get("/api/city.php", {
      level:2,
      province:province
    }, function(data){
      data = JSON.parse(data);
      console.log(data);
      var html = '<option value="">===请选择市===</option>';
      for (var i = 0; i < data.length; i++) {
        html += '<option value="'+data[i]+'">'+data[i]+'</option>';
      }
      $('#city').html(html).val('<{$actor_data.city}>');
    })
  }

  $('#province').change(function(){
    var obj = $(this);
    var val = obj.val();
    console.log(obj);
    if(!!val) {
      updateCity(val);
    }
  });

  var province = '<{$actor_data.province}>';
  if(!!province){
    updateCity(province);
  }
})
</script>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
