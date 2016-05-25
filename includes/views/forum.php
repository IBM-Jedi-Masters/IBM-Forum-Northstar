<?php

if (!defined('ABSPATH')) exit;

if (!is_user_logged_in()) {
    echo '<div class="info">'.__('You need to login in order to create posts and topics.', 'asgaros-forum').'&nbsp;<a href="'.wp_login_url(get_permalink()).'">&raquo; '.__('Login', 'asgaros-forum').'</a></div>';
}

?>
<div class="ibm-col-6-4">
<div>
    <div class=""><?php echo $this->forum_menu('forum'); ?></div>
    <div class="clear"></div>
</div>

<?php if ($counter_total > 0) { ?>
    <table id="<?php echo $category->name; ?>" data-widget="datatable" data-info="true" data-ordering="true" class="ibm-data-table">
    <caption class="ibm-bold ibm-padding-top-1"><?php echo $this->get_name($this->current_forum, $this->table_forums); ?></caption>
            <thead class="ibm-background-blue-core ibm-textcolor-white-core">
            <tr> 
                <th>Threads</th>
                <th>Stats</th>
                <th>Info</th>
            </tr>
        </thead>
    <tbody class="">
        <?php if ($sticky_threads && !$this->current_page) { ?>
            <?php foreach ($sticky_threads as $thread) { ?>
                <tr>
                    <td>
                        <strong><a href="<?php echo $this->get_link($thread->id, $this->url_thread); ?>"><?php echo $this->cut_string($thread->name); ?></a></strong>
                        <br><small><?php _e('Created by:', 'asgaros-forum'); ?> <i><?php echo $this->get_username($this->get_thread_starter($thread->id)); ?></i></small>
                    </td>
                    <td>
                        <small><?php _e('Answers', 'asgaros-forum'); ?>: <?php echo (int) ($this->count_elements($thread->id, $this->table_posts) - 1); ?></small>
                        <small><?php _e('Views', 'asgaros-forum'); ?>: <?php echo (int) $thread->views; ?></small>
                    </td>
                    <td><?php echo $this->get_lastpost_in_thread($thread->id); ?></td>
                </tr>
            <?php }
        } 
        foreach ($threads as $thread) { ?>
            <tr>
                <td class="">
                    <strong><a href="<?php echo $this->get_link($thread->id, $this->url_thread); ?>"><?php echo $this->cut_string($thread->name); ?></a></strong>
                    <br><small><?php _e('Created by:', 'asgaros-forum'); ?> <i><?php echo $this->get_username($this->get_thread_starter($thread->id)); ?></i></small>
                </td>
                <td class="">
                    <small><?php _e('Answers', 'asgaros-forum'); ?>: <?php echo (int) ($this->count_elements($thread->id, $this->table_posts) - 1); ?></small>
                    <br><small><?php _e('Views', 'asgaros-forum'); ?>: <?php echo (int) $thread->views; ?></small>
                </td>
                <td class=""><?php echo $this->get_lastpost_in_thread($thread->id); ?></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>

    <div>
        <div class="pages">
            <?php if ($counter_normal > 0) {
                echo $this->pageing($this->table_threads);
            } ?>
        </div>
        <div class=""><?php echo $this->forum_menu('forum'); ?></div>
        <div class="clear"></div>
    </div>
<?php } else { ?>
    <div class="notice"><?php _e('There are no threads yet!', 'asgaros-forum'); ?></div>
<?php } ?>
</div>
