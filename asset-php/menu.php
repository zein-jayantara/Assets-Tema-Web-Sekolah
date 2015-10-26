<?php 

$args = array(
    'child_of' => 0,
    'sort_order' => 'ASC',
    'sort_column' => 'ID',
    'hierarchical' => 1,
    'parent' => 0,
    'post_type' => 'page',
    'post_status' => 'publish'
); 

$limit = 4;

$topLevelPages = get_pages($args);
$count = count($topLevelPages);
?>


		<div class="nav-head">
  <?php $childPages = array();?>
      <ul class="nav-menu sf-js-enabled" id="menu-primary">
         <li class="page-item " id="menu-item-76"><a href="<?php echo get_option('home'); ?>">Beranda</a></li>
         <?php  if($topLevelPages) :  foreach($topLevelPages as $pageTop) : ?>
         <?php if($i == $limit)  : ?>
             <li class="menu-item" id="menu-item-<?php echo $pageTop->ID?>"><a href="<?php echo get_permalink( $pageTop->ID)?>" title="<?php echo $pageTop->post_title ?>">Menu Lainnya &raquo;</a>
               <ul class="children sf-js-enabled">            
         <?php endif; ?>
         <?php 
            $args = array(
                'child_of' => 0,
                'hierarchical' => 0,
                'parent' => (integer) $pageTop->ID,
                'post_type' => 'page',
                'sort_column' => 'ID',
                'post_status' => 'publish'
            ); 
            
                  $childPages = get_pages($args);
                  if($childPages) :  ?>
                  <li class="menu-item " id="menu-item-<?php echo $pageTop->ID?>"><a href="<?php echo get_permalink( $pageTop->ID)?>" title="<?php echo $pageTop->post_title ?>"><?php echo $pageTop->post_title . ($childPages ? ' &raquo;' : ''); ?></a>
                           <ul class="children">
                              <?php foreach($childPages as $pageChild) : ?>
                              <?php   
                                     $args2 = array(
                                        'child_of' => 0,
                                        'hierarchical' => 0,
                                        'parent' => (integer) $pageChild->ID,
                                        'post_type' => 'page',
                                        'sort_column' => 'ID',
                                        'post_status' => 'publish'
                                    ); 
                                    $childPages2 = get_pages($args2); ?>  
                                    
                                    <?php   if($childPages2) :  ?>
                                          <li class="menu-item " id="menu-item-<?php echo $pageTop->ID?>"><a href="<?php echo get_permalink( $pageTop->ID)?>" title="<?php echo $pageTop->post_title ?>"><?php echo $pageTop->post_title . ($childPages ? ' &raquo;' : ''); ?></a>
                                             <ul class="children">
                                                <?php foreach($childPages2 as $pageChild2) : ?>
                                                      <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="<?php echo get_permalink( $pageChild2->ID) ?>" title="<?php echo $pageChild2->post_title ?>"><?php echo $pageChild2->post_title ?></a></li>
                                                <?php    endforeach;?>
                                             </ul>  
                                       
                                    <?php else : ?>
                                       <li class="menu-item "><a href="<?php echo get_permalink( $pageChild->ID) ?>" title="<?php echo $pageChild->post_title ?>"><?php echo $pageChild->post_title ?></a></li>
                                    <?php endif;  ?>
                              <?php 
                              endforeach; ?>
                           </ul>
                  </li>
                 <? else : ?>
                  <li><a href="<?php echo get_permalink( $pageTop->ID)?>" title="<?php echo $pageTop->post_title ?>"><?php echo $pageTop->post_title . ($childPages ? ' &raquo;' : ''); ?></a>
                 <? endif;?>
                                  
           <?php $i++; 
           if($i == $count)  : ?>
             </li></ul>            
         <?php endif;endforeach; 
           endif;?>
      </ul>
</div>
<div class="clear"></div>
