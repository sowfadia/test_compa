<!-- Modal Structure -->
<div id="search-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Search</h4>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <?php echo generateHTMLSelect('Brand',               'brand',            $allBrand, false);?>
                    <?php echo generateHTMLSelect('Waterproof',          'waterproof',       $allWaterproofs, false);?>
                    <?php echo generateHTMLSelect('Screen Definition',   'screendefinition', $allScreenDefinitions, false);?>
                    <?php echo generateHTMLSelect('ScreenPanels',        'screenpanel',      $allScreenPanels, false);?>
                    <?php echo generateHTMLSelect('CPU Model',           'cpumodel',         $allCPUModels, false);?>
                    <?php echo generateHTMLSelect('OS',                  'software',         $allSoftwares, false);?>
                    
                    <?php echo generateHTMLSlider('Price', 'price_modal'); ?>
                    <?php echo generateHTMLSlider('Screen Resolution', 'screenresolution_modal'); ?>
                    <?php echo generateHTMLSlider('Screen Size', 'screensize_modal'); ?>
                    <?php echo generateHTMLSlider('CPU Frequency', 'cpufrequency_modal'); ?>
                    <?php echo generateHTMLSlider('CPU Core', 'cpucore_modal'); ?>
                    <?php echo generateHTMLSlider('Ram', 'ram_modal'); ?>
                    <?php echo generateHTMLSlider('Camera Resolution', 'cameraresolution_modal'); ?>
                    <?php echo generateHTMLSlider('Front Camera Resolution', 'frontcameraresolution_modal'); ?>
                    <?php echo generateHTMLSlider('Heigh', 'sizeheigh_modal'); ?>
                    <?php echo generateHTMLSlider('Width', 'sizewidth_modal'); ?>
                    <?php echo generateHTMLSlider('Thickness', 'sizethickness_modal'); ?>
                    <?php echo generateHTMLSlider('Weith', 'weight_modal'); ?>
                    <?php echo generateHTMLSlider('Battery Capacity', 'batterycapacity_modal'); ?>
                    <?php echo generateHTMLSlider('Storage', 'storage_modal'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
    </div>
</div>
