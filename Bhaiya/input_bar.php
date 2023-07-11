<header class="pb-4">

    <? if(!isset($_GET[$unique])){?>



    <span class="oe_form_buttons_edit" style="display: inline;">

      <button name="insert" accesskey="S" class="btn1 btn1-bg-submit" type="submit">Save</button>

    </span>

    <? }?>

    <? if(!isset($_GET[$unique])){/*?>

    <span class="oe_form_buttons_edit" style="display: inline;">

      <button name="insertn" accesskey="S" class="btn btn-primary" type="submit">Save & New</button>

    </span>

    <? */}?>

    <? if(isset($_GET[$unique])){?>

    <span class="oe_form_buttons_edit" style="display: inline;">

      <button name="update" accesskey="S" class=" btn1 btn1-bg-submit" type="submit">Update</button>

    </span>

    <? }?>

    <span class="oe_form_buttons_edit" style="display: inline;">

    <button name="reset" class="btn1 btn1-bg-cancel" type="submit" onclick="parent.parent.GB_hide();">Reset</button>

    </span>

    <span class="oe_form_buttons_edit" style="display: inline;">

    <button class="btn1 btn1-bg-update" type="button" onclick="parent.parent.document.location.href = '../<?=$root?>/<?=$page?>';">Show All</button>

    </span>

    <? if(isset($_GET[$unique])){?>

    <span class="oe_form_buttons_edit" style="display: inline;">

    <button name="delete" accesskey="S" class="btn1 btn1-bg-cancel" type="submit">Delete</button>

    </span>

    <? }?>

   <div class="oe_clear"></div>

</header>





