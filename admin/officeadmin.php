<?php

session_start();

include 'header.php';
include 'topmain.php';
echo "<title>$title - Office Summary</title>\n";
?>

<script type="text/javascript">
//<![CDATA[
function update_favorites() {
    var office = getCookie("office_name");
    $(".office_fav").each(function(idx, item) {
        item = $(item);
        if (office != null && item.attr("data") == office) {
            item.html("&#x2605;");
            item.css("color", "#ff9800");
        }
        else {
            item.html("&#x2606;");
            item.css("color", "#000000");
        }
    });
}

function set_fav(name) {
    if ($.trim(name).length > 0) {
        setCookie("office_name", name, 7000, "/");
    } else {
        setCookie("office_name", "", -1, "/");
    }
    update_favorites();
}

$(update_favorites);
//]]>
</script>

<?php

$self = $_SERVER['PHP_SELF'];
$request = $_SERVER['REQUEST_METHOD'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (!isset($_SESSION['valid_user'])) {

    echo "<table width=100% border=0 cellpadding=7 cellspacing=1>\n";
    echo "  <tr class=right_main_text><td height=10 align=center valign=top scope=row class=title_underline>PHP Timeclock Administration</td></tr>\n";
    echo "  <tr class=right_main_text>\n";
    echo "    <td align=center valign=top scope=row>\n";
    echo "      <table width=200 border=0 cellpadding=5 cellspacing=0>\n";
    echo "        <tr class=right_main_text><td align=center>You are not presently logged in, or do not have permission to view this page.</td></tr>\n";
    echo "        <tr class=right_main_text><td align=center>Click <a class=admin_headings href='../login.php'><u>here</u></a> to login.</td></tr>\n";
    echo "      </table><br /></td></tr></table>\n";
    exit;
}

echo "<table width=100% height=89% border=0 cellpadding=0 cellspacing=1>\n";
echo "  <tr valign=top>\n";
echo "    <td class=left_main width=180 align=left scope=col>\n";
echo "      <table class=hide width=100% border=0 cellpadding=1 cellspacing=0>\n";
echo "        <tr><td class=left_rows height=11></td></tr>\n";
echo "        <tr><td class=left_rows_headings height=18 valign=middle>Users</td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user.png' alt='User Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='useradmin.php'>User Summary</a></td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user_add.png' alt='Create New User' />&nbsp;&nbsp;
                <a class=admin_headings href='usercreate.php'>Create New User</a></td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/magnifier.png' alt='User Search' />&nbsp;&nbsp;
                <a class=admin_headings href='usersearch.php'>User Search</a></td></tr>\n";
echo "        <tr><td class=left_rows height=33></td></tr>\n";
echo "        <tr><td class=left_rows_headings height=18 valign=middle>Offices</td></tr>\n";
echo "        <tr><td class=current_left_rows height=18 align=left valign=middle><img src='../images/icons/brick.png' alt='Office Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='officeadmin.php'>Office Summary</a></td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick_add.png' alt='Create New Office' />&nbsp;&nbsp;
                <a class=admin_headings href='officecreate.php'>Create New Office</a></td></tr>\n";
echo "        <tr><td class=left_rows height=33></td></tr>\n";
echo "        <tr><td class=left_rows_headings height=18 valign=middle>Groups</td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group.png' alt='Group Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='groupadmin.php'>Group Summary</a></td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group_add.png' alt='Create New Group' />&nbsp;&nbsp;
                <a class=admin_headings href='groupcreate.php'>Create New Group</a></td></tr>\n";
echo "        <tr><td class=left_rows height=33></td></tr>\n";
echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>In/Out Status</td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application.png' alt='Status Summary' />
                &nbsp;&nbsp;<a class=admin_headings href='statusadmin.php'>Status Summary</a></td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application_add.png' alt='Create Status' />&nbsp;&nbsp;
                <a class=admin_headings href='statuscreate.php'>Create Status</a></td></tr>\n";
echo "        <tr><td class=left_rows height=33></td></tr>\n";
echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>Miscellaneous</td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/clock.png' alt='Add/Edit/Delete Time' />
                &nbsp;&nbsp;<a class=admin_headings href='timeadmin.php'>Add/Edit/Delete Time</a></td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application_edit.png' alt='Edit System Settings' />
                &nbsp;&nbsp;<a class=admin_headings href='sysedit.php'>Edit System Settings</a></td></tr>\n";
echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/database_go.png'
                alt='Upgrade Database' />&nbsp;&nbsp;&nbsp;<a class=admin_headings href='dbupgrade.php'>Upgrade Database</a></td></tr>\n";
echo "      </table></td>\n";
echo "    <td align=left class=right_main scope=col>\n";
echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
echo "        <tr class=right_main_text>\n";
echo "          <td valign=top>\n";
echo "            <table width=60% align=center height=40 border=0 cellpadding=0 cellspacing=0>\n";
echo "              <tr><th class=table_heading_no_color nowrap width=100% valign=top halign=left>Office Summary</th></tr>\n";
echo "            </table>\n";
echo "            <table class=table_border width=60% align=center border=0 cellpadding=0 cellspacing=0>\n";
echo "              <tr>\n";
echo "                <th class=table_heading nowrap width=5% align=left>&nbsp;</th>\n";
echo "                <th class=table_heading nowrap width=5% align=center><span class=\"office_fav\" onclick=\"set_fav('');\">&#x2606;</span></th>\n";
echo "                <th class=table_heading nowrap width=75% align=left1>Office Name</th>\n";
echo "                <th class=table_heading nowrap width=4% align=center>Groups</th>\n";
echo "                <th class=table_heading nowrap width=4% align=center>Users</th>\n";
echo "                <th class=table_heading nowrap width=3% align=center>Edit</th>\n";
echo "                <th class=table_heading nowrap width=3% align=center>Delete</th></tr>\n";

$row_count = 0;

$result = tc_select("*", "offices", "1=1 ORDER BY officename");

while ($row = mysqli_fetch_array($result)) {

    @$user_cnt  = mysqli_num_rows(tc_select("1", "employees", "office = ?", $row['officename']));
    @$group_cnt = mysqli_num_rows(tc_select("1", "groups",  "officeid = ?", $row['officeid']));

    $row_count++;
    $row_color = ($row_count % 2) ? $color2 : $color1;

    $h_office = htmlentities($row["officename"]);

    echo "<tr class=table_border bgcolor='$row_color'>\n";
    echo "    <td nowrap class=table_rows width=5%>&nbsp;$row_count</td>\n";
    echo "    <td nowrap class=table_rows width=5% align=center><span class=\"office_fav\" onclick=\"set_fav('$h_office');\" data=\"$h_office\"></span></td>\n";
    echo "    <td nowrap class=table_rows width=75%>&nbsp;<a class=footer_links title='Edit Office: " . $row["officename"] . "'
                  href=\"officeedit.php?officename=" . $row["officename"] . "\">" . $row["officename"] . "</a></td>\n";
    echo "    <td class=table_rows width=4% align=center>$group_cnt</td>\n";
    echo "    <td class=table_rows width=4% align=center>$user_cnt</td>\n";

    echo "    <td class=table_rows width=3% align=center><a href=\"officeedit.php?officename=" . $row["officename"] . "\"
                  title=\"Edit Office: " . $row["officename"] . "\">
                  <img border=0 src='../images/icons/application_edit.png' /></a></td>\n";
    echo "    <td class=table_rows width=3% align=center><a href=\"officedelete.php?officename=" . $row["officename"] . "\"
                  title=\"Delete Office: " . $row["officename"] . "\">
                  <img border=0 src='../images/icons/delete.png' /></a></td></tr>\n";
}
echo "            </table></td></tr>\n";
include '../footer.php';
exit;
?>
