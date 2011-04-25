<?php

/**
 * PluginCommunityWiki
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginCommunityWiki extends BaseCommunityWiki
{
  public function isEditable($memberId)
  {
    if (!$this->getCommunity()->isPrivilegeBelong($memberId))
    {
      return false;
    }

    return ($this->getMemberId() === $memberId || $this->getCommunity()->isAdmin($memberId));
  }

  public function isWikiModified()
  {
    $modified = $this->getModified();
    return (isset($modified['name']) || isset($modified['body']));
  }

  public function preSave($event)
  {
    $modified = $this->getModified();
    if ($this->isWikiModified() && empty($modified['topic_updated_at']))
    {
      $this->setWikiUpdatedAt(date('Y-m-d H:i:s', time()));
    }
  }

  // for pager
  public function getImageFilename()
  {
    $this->getCommunity()->getImageFilename();
  }

  public function getImagesWithNumber()
  {
    $images = $this->getImages();
    $result = array();
    foreach ($images as $image)
    {
      $result[$image->number] = $image;
    }

    return $result;
  }

}