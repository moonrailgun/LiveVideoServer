<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a href="rule_modify.php" class="btn btn-primary"><i class="icon-edit"></i>修改</a>
</div>

<!-- tool2DirectiveRule -->
<div class="block">
    <a href="#page-stats1" class="block-heading" data-toggle="collapse">tool2DirectiveRule</a>
    <div id="page-stats1" class="block-body collapse in">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:20px">#</th>
                    <th style="width:80px">toolName</th>
                    <th style="width:200px">directiveName</th>
                    <th style="width:200px">address</th>
                    <th style="width:200px">command</th>
                    <th style="width:200px">param</th>
                    <!-- <th style="width:80px">操作</th> -->
                </tr>
            </thead>
            <tbody>
            <{foreach name=tool2DirectiveRule from=$tool2DirectiveRule item=rule_item}>
                <tr>
                    <td>
                        <{$smarty.foreach.tool2DirectiveRule.index}>
                    </td>
                    <td>
                        <{$rule_item['toolName']}>
                    </td>
                    <td>
                        <{$rule_item['directiveName']}>
                    </td>
                    <td>
                        <{$rule_item['address']}>
                    </td>
                    <td>
                        <{$rule_item['command']}>
                    </td>
                    <td>
                        <{$rule_item['param']}>
                    </td>
                    <!-- <td>
                        <a href="user_modify.php?user_id=<{$user_info.user_id}>" title="修改">
                          <i class="icon-pencil"></i>
                        </a>
                        &nbsp;
                        <a data-toggle="modal" href="#myModal" title="删除">
                          <i class="icon-remove" href="#" ></i>
                        </a>
                    </td> -->
                </tr>
            <{/foreach}>
            </tbody>
        </table>
    </div>
</div>

<!-- gift2SenderInfoRule -->
<div class="block">
    <a href="#page-stats2" class="block-heading" data-toggle="collapse">gift2SenderInfoRule</a>
    <div id="page-stats2" class="block-body collapse in">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:20px">#</th>
                    <th style="width:80px">giftType</th>
                    <th style="width:100px">giftAmount</th>
                    <th style="width:100px">mapToolName</th>
                    <!-- <th style="width:80px">操作</th> -->
                </tr>
            </thead>
            <tbody>
            <{foreach name=gift2SenderInfoRule from=$gift2SenderInfoRule item=rule_item}>
                <tr>
                    <td>
                        <{$smarty.foreach.gift2SenderInfoRule.index}>
                    </td>
                    <td>
                        <{$rule_item['giftType']}>
                    </td>
                    <td>
                        <{$rule_item['giftAmount']}>
                    </td>
                    <td>
                        <{$rule_item['mapToolName']}>
                    </td>
                    <!-- <td>
                        <a href="user_modify.php?user_id=<{$user_info.user_id}>" title="修改">
                          <i class="icon-pencil"></i>
                        </a>
                        &nbsp;
                        <a data-toggle="modal" href="#myModal" title="删除">
                          <i class="icon-remove" href="#" ></i>
                        </a>
                    </td> -->
                </tr>
            <{/foreach}>
            </tbody>
        </table>
    </div>
</div>

<!-- costControlRule -->
<div class="block">
    <a href="#page-stats3" class="block-heading" data-toggle="collapse">costControlRule</a>
    <div id="page-stats3" class="block-body collapse in">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:20px">#</th>
                    <th style="width:80px">toolName</th>
                    <th style="width:200px">toolCost</th>
                    <!-- <th style="width:80px">操作</th> -->
                </tr>
            </thead>
            <tbody>
            <{foreach name=costControlRule from=$costControlRule item=rule_item}>
                <tr>
                    <td>
                        <{$smarty.foreach.costControlRule.index}>
                    </td>
                    <td>
                        <{$rule_item['toolName']}>
                    </td>
                    <td>
                        <{$rule_item['toolCost']}>
                    </td>
                    <!-- <td>
                        <a href="user_modify.php?user_id=<{$user_info.user_id}>" title="修改">
                          <i class="icon-pencil"></i>
                        </a>
                        &nbsp;
                        <a data-toggle="modal" href="#myModal" title="删除">
                          <i class="icon-remove" href="#" ></i>
                        </a>
                    </td> -->
                </tr>
            <{/foreach}>
            </tbody>
        </table>
    </div>
</div>

<!-- controllerDirectiveRule -->
<div class="block">
	<a href="#page-stats4" class="block-heading" data-toggle="collapse">controllerDirectiveRule</a>
	<div id="page-stats4" class="block-body collapse in">

	 <table class="table table-striped">
     <tbody>
  			<tr><td style="width:300px;">format</td><td style="width:600px;"><{$controllerDirectiveRule['format']}></td></tr>
  			<tr><td>directiveName</td><td><{$controllerDirectiveRule['directiveName']}></td></tr>
  			<tr><td>description</td><td><{$controllerDirectiveRule['description']}></td></tr>
      </tbody>
    </table>
	</div>
</div>

<!-- acquisitionRule -->
<div class="block">
	<a href="#page-stats5" class="block-heading" data-toggle="collapse">acquisitionRule</a>
	<div id="page-stats5" class="block-body collapse in">

	 <table class="table table-striped">
     <tbody>
  			<tr><td style="width:300px;">userID</td><td style="width:600px;"><{$acquisitionRule['userID']}></td></tr>
  			<tr><td>userName</td><td><{$acquisitionRule['userName']}></td></tr>
  			<tr><td>giftType</td><td><{$acquisitionRule['giftType']}></td></tr>
        <tr><td>giftAmount</td><td><{$acquisitionRule['giftAmount']}></td></tr>
        <tr><td>sendTime</td><td><{$acquisitionRule['sendTime']}></td></tr>
        <tr><td>actorID</td><td><{$acquisitionRule['actorID']}></td></tr>
        <tr><td>actorName</td><td><{$acquisitionRule['actorName']}></td></tr>
      </tbody>
    </table>
	</div>
</div>

<!-- 操作的确认层，相当于javascript:confirm函数 -->
<{$osadmin_action_confirm}>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
