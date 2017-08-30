<?php

namespace Drupal\invoices\Entity\Controller;


use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class InvoiceListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Id');
    $header['year'] = $this->t('Year');
    $header['month'] = $this->t('Month');
    $header['number'] = $this->t('Number');
    $header['note'] = $this->t('Note');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['year'] = $entity->year->value;
    $row['month'] = $entity->month->value;
    $row['number'] = $entity->number->value;
    $row['note'] = $entity->note->value;
    return $row + parent::buildRow($entity);
  }
}