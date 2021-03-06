<?php

defined('TYPO3_MODE') or die();

(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Mask',
        'tools',
        'mask',
        'bottom',
        [
            \MASK\Mask\Controller\WizardController::class => 'list, createMissingFolders',
            \MASK\Mask\Controller\WizardContentController::class => 'list, new, create, edit, update, delete, purge, generate, showHtml, createMissingFolders, hide, activate, createHtml',
            \MASK\Mask\Controller\WizardPageController::class => 'list, new, create, edit, update, delete, showHtml',
        ],
        [
            'access' => 'admin',
            'icon' => 'EXT:mask/Resources/Public/Icons/module-mask_wizard.svg',
            'labels' => 'LLL:EXT:mask/Resources/Private/Language/locallang_mask.xlf',
        ]
    );

    // include css for styling of backend preview of mask content elements
    $GLOBALS['TBE_STYLES']['skins']['mask']['name'] = 'mask';
    $GLOBALS['TBE_STYLES']['skins']['mask']['stylesheetDirectories'][] = 'EXT:mask/Resources/Public/Styles/Backend/';

    // Allow all inline tables on standard pages
    $tcaCodeGenerator = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(MASK\Mask\CodeGenerator\TcaCodeGenerator::class);
    $irreTables = $tcaCodeGenerator->getMaskIrreTables();
    foreach ($irreTables as $table) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages($table);
    }
})();
