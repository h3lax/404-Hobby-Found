<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container76CROnZ\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container76CROnZ/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container76CROnZ.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container76CROnZ\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container76CROnZ\App_KernelDevDebugContainer([
    'container.build_hash' => '76CROnZ',
    'container.build_id' => '6f9e8c8e',
    'container.build_time' => 1727253786,
], __DIR__.\DIRECTORY_SEPARATOR.'Container76CROnZ');
