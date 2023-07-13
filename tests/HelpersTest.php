<?php

test('src_path is registered', function () {
    expect(src_path())->toBe(app()->basePath('/src'));
});
