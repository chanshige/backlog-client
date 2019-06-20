<?php
namespace Chanshige\Backlog\Resource;

/**
 * Class Issues
 *
 * @method Issues comments(?int $commentId = null)
 * @method Issues notifications()
 * @method Issues attachments(?int $attachmentId = null)
 * @method Issues sharedFiles(?int $id = null)
 *
 * @property integer|array projectId
 * @property integer|array issueTypeId
 * @property integer|array categoryId
 * @property integer|array versionId
 * @property integer|array milestoneId
 * @property integer|array statusId
 * @property integer|array priorityId
 * @property integer|array assigneeId
 * @property integer|array createdUserId
 * @property integer|array resolutionId
 * @property integer       parentChild
 * @property bool          attachment
 * @property bool          sharedFile
 * @property string        sort
 * @property string        order
 * @property integer       offset
 * @property integer       count
 * @property string        createdSince
 * @property string        createdUntil
 * @property string        updatedSince
 * @property string        updatedUntil
 * @property string        startDateSince
 * @property string        startDateUntil
 * @property string        dueDateSince
 * @property string        dueDateUntil
 * @property int|array     id
 * @property int|array     parentIssueId
 * @property string        keyword
 * @package Chanshige\Backlog\Resource
 */
final class Issues extends AbstractResource
{
    protected $name = ['issues'];
}
