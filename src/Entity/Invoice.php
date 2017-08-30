<?php
/**
 * Created by PhpStorm.
 * User: etown_009
 * Date: 2017/8/29
 * Time: 下午 01:37
 */

namespace Drupal\invoices\Entity;


use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Class Invoice
 *
 * @package Drupal\invoices\Entity
 *
 * @ContentEntityType(
 *   id = "invoices_invoice",
 *   label = @Translation("Invoice"),
 *   admin_permission = "administer content",
 *   handlers = {
 *    "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *    "list_builder" = "Drupal\invoices\Entity\Controller\InvoiceListBuilder",
 *    "form" = {
 *      "add" = "Drupal\Core\Entity\ContentEntityForm",
 *      "edit" = "Drupal\Core\Entity\ContentEntityForm",
 *      "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *    }
 *   },
 *   base_table = "invoices_invoice",
 *   entity_keys = {
 *    "id" = "id",
 *    "uuid" = "uuid"
 *   },
 *   links = {
 *    "canonical" = "/invoices_invoice/{invoices_invoice}",
 *    "collection" = "/invoices_invoice/list",
 *    "edit-form" = "/invoices_invoice/{invoices_invoice}/edit",
 *    "delete-form" = "/invoices_invoice/{invoices_invoice}/delete"
 *   }
  * )
 */
class Invoice extends ContentEntityBase implements ContentEntityInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['year'] = BaseFieldDefinition::create("integer")
      ->setLabel(t("Year"))
      ->setSettings([
        'min' => 100,
        'max' => 200 // TODO change this after Taiwan year 200
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
        'weight' => 1
      ]);

    $fields['month'] = BaseFieldDefinition::create('list_integer')
      ->setLabel(t('Month'))
      ->setSettings([
        'min' => 1,
        'max' => 12,
        'suffix' => 'month',
        'allowed_values' => [
          1 => '1 ~ 2',
          2 => '3 ~ 4',
          3 => '5 ~ 6',
          4 => '7 ~ 8',
          5 => '9 ~ 10',
          6 => '11 ~ 12'
        ]
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 2
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
        'weight' => 2
      ]);

    $fields['number'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Number'))
      ->setSettings([
        'max_length' => 8
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 3
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
        'weight' => 3
      ]);

    $fields['note'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Note'))
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
        'rows' => 4,
        'weight' => 4
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
        'weight' => 4
      ]);

    return $fields;
  }
}