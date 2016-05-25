<?php

if (!defined('ABSPATH')) exit;

$forum_counter = 0;

?>
<div class="ibm-col-6-4">
<?php foreach ($categories as $category) { ?>
    <table id="<?php echo $category->name; ?>" class="ibm-data-table">
    <caption class="ibm-bold ibm-padding-top-1"><?php echo $category->name; ?></caption>
        <thead class="ibm-background-blue-core ibm-textcolor-white-core">
            <tr> 
                <th>Forums</th>
                <th>Stats</th>
                <th>Info</th>
            </tr>
        </thead>
    <tbody class="content-element space">
        <?php
        $frs = $this->get_forums($category->term_id);
        if (count($frs) > 0) {
            foreach ($frs as $forum) {
                $forum_counter++;
                $lastpost_data = $this->get_lastpost_data($forum->id, 'p.parent_id', 't');
                $lastpost_parent_id = ($lastpost_data) ? $lastpost_data->parent_id : false;
                ?>
                <tr class="">
                    <td class="forum-name">
                        <strong><?php $this->get_thread_image($lastpost_data); ?><a href="<?php echo $this->get_link($forum->id, $this->url_forum); ?>"><?php echo $forum->name; ?></a></strong>
                        <small><?php echo $forum->description; ?></small>
                    </td>
                    <td class="forum-stats">
                        <small><?php _e('Threads:', 'asgaros-forum'); ?> <?php echo $this->count_elements($forum->id, $this->table_threads); ?></small>
                        <br><small><?php _e('Posts:', 'asgaros-forum'); ?> <?php echo $this->count_posts_in_forum($forum->id); ?></small>
                    </td>
                    <td class="forum-poster"><?php echo $this->get_lastpost_in_forum($forum->id); ?></td>
                </tr>
            <?php
            }
        } else { ?>
            <tr><td class="notice"><?php _e('There are no forums yet!', 'asgaros-forum'); ?></td><td></td><td></td></tr>
        <?php } ?>
    </tbody>
    </table>
<?php } ?>
<?php if ($forum_counter > 0) { ?>
<div class="footer">
    <span class="icon-files-empty-small unread"></span><?php _e('New posts', 'asgaros-forum'); ?> &middot;
    <span class="icon-files-empty-small"></span><?php _e('No new posts', 'asgaros-forum'); ?> &middot;
    <span class="icon-checkmark"></span><a href="<?php echo $this->url_markallread; ?>"><?php _e('Mark All Read', 'asgaros-forum'); ?></a>
</div>
<?php } ?>
</div>
