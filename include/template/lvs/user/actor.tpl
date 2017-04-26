<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
  <a href="actor_add.php" class="btn btn-primary"><i class="icon-plus"></i> 主播</a>
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
		<label>平台名称</label>
    <select id="website_id" name="website_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$website_id_list selected=$_GET.website_id}>
    </select>
	</div>
  <div style="float:left;margin-right:5px">
    <label>工会名称</label>
    <select id="group_id" name="group_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$group_id_list selected=$_GET.group_id}>
    </select>
  </div>
  <div style="clear:both;"></div>
	<div style="float:left;margin-right:5px">
		<label>常驻地</label>
    <select id="province" name="province" class="input-xlarge">
      <option value="">===请选择省===</option>
      <{html_options values=$province_list output=$province_list selected=$_GET.province}>
    </select>
    <select id="city" name="city" class="input-xlarge" selected=<{$_GET.city}>>
      <option value="">===请选择市===</option>
    </select>
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
          $('#city').html(html).val('<{$_GET.city}>');
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

      var province = '<{$_GET.province}>';
      if(!!province){
        updateCity(province);
      }
    })
    </script>
	</div>
	<div class="btn-toolbar" style="padding-top:15px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary">检索</button>
	</div>
	<div style="clear:both;"></div>
</form>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">主播列表</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:120px">登录名</th>
        <th style="width:120px">姓名</th>
        <th style="width:120px">直播ID</th>
        <th style="width:120px">平台</th>
        <th style="width:120px">工会</th>
        <th style="width:80px">操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=actor from=$actor_list item=actor}>
      <tr>
        <td><{$actor.user_id}></td>
        <td><{$actor.real_name}></td>
        <td><{$actor.live_id}></td>
        <td><{$website_id_list[$actor.website_id]}></td>
        <td><{$group_id_list[$actor.group_id]}></td>
        <td>
          <a href="actor_modify.php?actor_id=<{$actor.id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="actor_delete.php?actor_id=<{$actor.id}>" ></i></a>
        </td>
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
