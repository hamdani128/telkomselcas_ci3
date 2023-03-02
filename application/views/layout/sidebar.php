<div class="br-logo"><a href=""><span>[</span>CAS <i>Analytic</i><span>]</span></a></div>
<div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="<?php echo base_url('home') ?>" class="br-menu-link <?= uri_string() == 'home' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">Home</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#"
                class="br-menu-link with-sub <?= uri_string() == 'cvm' || uri_string() == 'campaign/taker_wa' || uri_string() == 'campaign/taker_all_channel' || uri_string() == 'campaign_dev1/form_target_submittion' || uri_string() == 'campaign/taker_all_channel' || uri_string() == 'campaign_dev2/agile'  || uri_string() == 'postpaid/performance' ? 'active show-sub' : '' ?>">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Campaign</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub nav flex-column">
                <li class="sub-item">
                    <a href="<?= base_url('cvm') ?>" class="sub-link <?= uri_string() == 'cvm' ? 'active' : '' ?>">
                        Perfm.CVM
                    </a>
                </li>
                <li class="sub-item">
                    <a href="<?= base_url('campaign/taker_wa') ?>"
                        class="sub-link <?= uri_string() == 'campaign/taker_wa' ? 'active' : '' ?>">
                        Perfm. Taker Channel (WA)
                    </a>
                </li>
                <li class="sub-item">
                    <a href="<?= base_url('campaign/taker_all_channel') ?>"
                        class="sub-link <?= uri_string() == 'campaign/taker_all_channel' ? 'active' : '' ?>">
                        Perfm. Taker All Channel
                    </a>
                </li>
                <li class="sub-item">
                    <a href="<?= base_url('campaign_dev2/agile') ?>"
                        class="sub-link <?= uri_string() == 'campaign_dev2/agile' ? 'active' : '' ?>">
                        Agile Taker
                    </a>
                </li>
                <li class="sub-item">
                    <a href="<?= base_url('campaign_dev1/form_target_submittion') ?>"
                        class="sub-link <?= uri_string() == 'campaign_dev1/form_target_submittion' ? 'active' : '' ?>">
                        Upload Target WL
                    </a>
                </li>
                <li class="sub-item">
                    <a href="<?= base_url('postpaid/performance') ?>"
                        class="sub-link <?= uri_string() == 'postpaid/performance' ? 'active' : '' ?>">
                        Postpaid
                    </a>
                </li>
                <li class="sub-item"><a href="#" class="sub-link">Hash Whitelist</a></li>
            </ul>
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub">
                <i class="menu-item-icon icon ion-ios-color-filter-outline tx-24"></i>
                <span class="menu-item-label">Loyalty</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="#" class="sub-link">Perfm. Profiling Loyalty</a></li>
                <li class="sub-item"><a href="#" class="sub-link">Perfm. Report Poin</a></li>
                <li class="sub-item"><a href="#" class="sub-link">Upload Base On Poin</a></li>
            </ul>
        </li><!-- br-menu-item -->
    </ul><!-- br-sideleft-menu -->

    <br>
</div><!-- br-sideleft -->