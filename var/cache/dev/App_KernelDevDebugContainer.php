<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNXIDNix\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNXIDNix/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerNXIDNix.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerNXIDNix\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerNXIDNix\App_KernelDevDebugContainer([
    'container.build_hash' => 'NXIDNix',
    'container.build_id' => '78c559d0',
    'container.build_time' => 1727254692,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNXIDNix');
