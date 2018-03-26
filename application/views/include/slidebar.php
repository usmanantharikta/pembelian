<div class="page-sidebar-wrapper" style="background-color: #9E9E9E" >
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
      <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
      <li class="sidebar-toggler-wrapper">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler">
        </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
      </li>
      <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
      <li class="sidebar-search-wrapper">
        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
        <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
        <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
        <form class="sidebar-search " action="extra_search.html" method="POST">
          <a href="javascript:;" class="remove">
          <i class="icon-close"></i>
          </a>
          <!-- <div class="input-group">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
            </span>
          </div> -->
        </form>
        <!-- END RESPONSIVE QUICK SEARCH FORM -->
      </li>
      <li id="home" class="">
        <a href="<?php echo site_url('/pr');?>">
        <i class=" danger icon-home"></i>
        <span class="title">Home</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
      </li>
      <li id="pr" class="bod">
        <a href="javascript:;">
        <i class="icon-note"></i>
        <span class="title">PR</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <li>
            <a id="listopr" href="<?php echo site_url('/pr/list_pr');?>">
            List Outstanding PR</a>
          </li>
        </ul>
      </li>
      <li id="po" class="bod">
        <a href="javascript:;">
        <i class="icon-note"></i>
        <span class="title">PO</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <li class="">
            <a id="create_po" href="<?php echo site_url('/po/create_po_other');?>">
            Create PO</a>
          </li>
          <li class="">
            <a id="po_draf" href="<?php echo site_url('/po/list_po_draf');?>">
            List PO Draf</a>
          </li>
          <li>
            <a id="list_po_approval" href="<?php echo site_url('/po/list_po_approval');?>">
            List PO Approval</a>
          </li>
          <li>
            <a id="list_po_approved" href="<?php echo site_url('/po/list_po_approved');?>">
            List PO Approved</a>
          </li>
        </ul>
      </li>
      <li id="bum" class="bod">
        <a href="javascript:;">
        <i class="fa fa-cc-amex"></i>
        <span class="title">BUM</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <li>
            <a id="list_bum_approval" href="<?php echo site_url('/bum/');?>">
            List BUM Approval</a>
          </li>
          <li>
            <a id="list_bum_approved" href="<?php echo site_url('/bum/list_bum_approved');?>">
            List BUM Approved</a>
          </li>
          <li>
            <a id="list_bjum_approval" href="<?php echo site_url('/bum/list_bjum_approval');?>">
            List PJUM Approval</a>
          </li>
          <li>
            <a id="list_bjum_approved" href="<?php echo site_url('/bum/list_bjum_approved');?>">
            List PJUM Approved</a>
          </li>
        </ul>
      </li>
      <li id="cod" class="bod">
        <a href="javascript:;">
        <i class="fa fa-money"></i>
        <span class="title">COD</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <li>
            <a id="list_cod_input" href="<?php echo site_url('/bum/list_cod_input');?>">
            Input Doc COD</a>
          </li>
          <li>
            <a id="list_cod" href="<?php echo site_url('/bum/list_cod');?>">
            List COD</a>
          </li>
          <li>
            <a id="list_cod_r" href="<?php echo site_url('/bum/list_p_cod');?>">
            List Roll COD Approval</a>
          </li>
          <li>
            <a id="list_cod_ra" href="<?php echo site_url('/bum/list_approved_cod');?>">
            List Roll COD Approved</a>
          </li>
        </ul>
      </li>
      <li id="credit" class="bod">
        <a href="javascript:;">
        <i class="fa fa-credit-card"></i>
        <span class="title">Credit</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <li>
            <a id="list_credit" href="<?php echo site_url('/bum/list_credit');?>">
            List Credit</a>
          </li>
          <li>
            <a id="list_credit_approval" href="<?php echo site_url('/pjum/list_pjum_approval_c');?>">
            List TTBP Credit Approval</a>
          </li>
          <li>
            <a id="list_credit_approved" href="<?php echo site_url('/pjum/list_pjum_approved_c');?>">
            List TTBP Credit Approved</a>
          </li>
        </ul>
      </li>
      <li id="pp" class="bod">
        <a href="javascript:;">
        <i class="fa fa-cc-visa"></i>
        <span class="title">Progress Payment</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <li>
            <a id="list_pp" href="<?php echo site_url('/bum/list_pp');?>">
            List Progress Payment</a>
          </li>
          <li>
            <a id="list_pp_approval" href="<?php echo site_url('/pjum/list_pjum_approval_pp');?>">
            List TTBP PP Approval</a>
          </li>
          <li>
            <a id="list_pp_approved" href="<?php echo site_url('/pjum/list_pjum_approved_pp');?>">
            List TTBP PP Approved</a>
          </li>
        </ul>
      </li>
      <li id="bod" class="unbod hide">
        <a href="javascript:;">
        <i class="icon-note"></i>
        <span class="title">PO</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <!-- <li class="">
            <a id="po_draf" href="<?php echo site_url('/po/list_po_draf');?>">
            List PO Draf</a>
          </li> -->
          <li>
            <a id="list_bod_approval" href="<?php echo site_url('/bod/list_po_approval_bod');?>">
            List PO Approval</a>
          </li>
          <li>
            <a id="list_bod_approved" href="<?php echo site_url('/bod/list_po_approved_bod');?>">
            List PO Approved</a>
          </li>
        </ul>
      </li>
      <li id="bod-param" class="unbod hide">
        <a href="javascript:;">
        <i class="icon-note"></i>
        <span class="title">Parameter PO</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <!-- <li class="">
            <a id="po_draf" href="<?php echo site_url('/po/list_po_draf');?>">
            List PO Draf</a>
          </li> -->
          <li>
            <a id="param" href="<?php echo site_url('/bod/parameter');?>">
            Set Max Price PO</a>
          </li>
          <!-- <li>
            <a id="list_bod_approved" href="<?php echo site_url('/bod/list_po_approved_bod');?>">
            List PO Approved</a>
          </li> -->
        </ul>
      </li>

      <li id="gm" class="ungm hide">
        <a href="javascript:;">
        <i class="icon-note"></i>
        <span class="title">PO</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
          <!-- <li class="">
            <a id="po_draf" href="<?php echo site_url('/po/list_po_draf');?>">
            List PO Draf</a>
          </li> -->
          <li>
            <a id="list_gm_approval" href="<?php echo site_url('/gm/list_po_approval_gm');?>">
            List PO Approval</a>
          </li>
          <li>
            <a id="list_gm_approved" href="<?php echo site_url('/gm/list_po_approved_gm');?>">
            List PO Approved</a>
          </li>
        </ul>
      </li>
    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
