<?php
namespace Chanshige\Backlog\Resource;

/**
 * Class Issues
 *
 * @method Issues comments(?int $commentId = null)
 * @method Issues notifications()
 * @method Issues attachments(?int $attachmentId = null)
 * @method Issues sharedFiles(?int $id = null)
 * @package Chanshige\Backlog\Resource
 */
final class Issues extends AbstractResource
{
    protected $name = 'issues';
}
