<?php if ($userIsAuthenticated) : ?>
  <ul class="breadcrumb">
    <li class="home <?php echo !$currentBreadCrumbRepository ? 'selected' : '' ?>"><?php echo link_to('Crew', '@homepage', array('class' => 'logo')) ?></li>
    <?php if ($currentBreadCrumbRepository): ?>
      <?php $repositoryNeedList = sizeof($repositoryBreadCrumbList) ?>
      <li class="<?php echo !$currentBreadCrumbBranch ? 'selected' : '' ?> <?php echo $repositoryNeedList ? 'dropdown' : '' ?>">
        <span class="ricon">Ø</span>
        <?php echo link_to($currentBreadCrumbRepository, 'default/branchList?repository=' . $currentBreadCrumbRepository->getId()) ?>
        <?php if($repositoryNeedList): ?>
          <?php echo link_to('@', '@homepage', array('class' => 'dropdown-toggle')) ?>
          <ul class="dropdown-menu">
            <?php foreach ($repositoryBreadCrumbList as $item): ?>
              <li><?php echo link_to($item, 'default/branchList?repository=' . $item->getId()) ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </li>
    <?php endif; ?>
    <?php $defaultParametersUrlFile = array(
      'from' => $commit_from,
      'to'   => $commit_to,
    ); ?>
    <?php if ($currentBreadCrumbBranch): ?>
      <?php $branchNeedList = sizeof($branchBreadCrumbList) ?>
      <li class="<?php echo !$currentBreadCrumbFile ? 'selected' : '' ?> <?php echo $branchNeedList ? 'dropdown' : '' ?>">
        <span class="ricon">.</span>
        <?php echo link_to($currentBreadCrumbBranch, 'default/fileList?' . http_build_query(array_merge($defaultParametersUrlFile, array('branch' => $currentBreadCrumbBranch->getId())))) ?>
        <?php if($branchNeedList): ?>
          <?php echo link_to('@', '@homepage', array('class' => 'dropdown-toggle')) ?>
          <ul class="dropdown-menu">
            <?php foreach ($branchBreadCrumbList as $item): ?>
              <li>
                <span class="ricon"><?php if($item->getStatus() == 1): ?>Ã<?php elseif($item->getStatus() == 2): ?>Â<?php else: ?>!<?php endif; ?></span>
                <?php echo link_to($item, 'default/fileList?branch=' . $item->getId()) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($currentBreadCrumbFile): ?>
      <?php $fileNeedList = sizeof($fileBreadCrumbList) ?>
      <li class="selected<?php echo $fileNeedList ? ' dropdown' : '' ?>">
        <span class="ricon">E</span>
        <?php echo link_to(stringUtils::shortenFilePath($currentBreadCrumbFile), 'default/file?' . http_build_query(array_merge($defaultParametersUrlFile, array('file' => $currentBreadCrumbFile->getId()))), array('class' => 'tooltip', 'title' => $currentBreadCrumbFile)) ?>
        <?php if($fileNeedList): ?>
          <?php echo link_to('@', '@homepage', array('class' => 'dropdown-toggle')) ?>
          <ul class="dropdown-menu">
            <?php foreach ($fileBreadCrumbList as $item): ?>
              <li>
                <span class="ricon"><?php if($item->getStatus() == 1): ?>Ã<?php elseif($item->getStatus() == 2): ?>Â<?php else: ?>!<?php endif; ?></span>
                <?php echo link_to($item, 'default/file?' . http_build_query(array_merge($defaultParametersUrlFile, array('file' => $item->getId())))) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </li>
    <?php endif; ?>
  </ul>
<?php endif; ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('.breadcrumb').dropdown()
  })
</script>
