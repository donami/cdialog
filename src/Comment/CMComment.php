<?php
/**
 * To attach comments-flow to a page or some content.
 *
 */
namespace Phpmvc\Comment;

class CCommentInSession {

  /**
   * Properties
   *
   */
  private $options  = array();  // Options for behavior, set through constructor.
  private $comments = array();  // Holder for all comments once loaded.
  private $data     = array();  // Holder for one active comment or new comment to create.


  /**
   * Constructor
   *
   * @param array $options to configure object, send in array to overwrite default setup.
   */
  public function __construct( $options = array() ) {
    $defaults = array(
      'key'         => 'no-key',    // Id to attach comments to a certain object
      'session-key' => __CLASS__,   // Key used to store session data in.
    );
    $this->options = array_merge($defaults, $options);
  }



  /**
   * Return string representation of class.
   *
   * @return string representing class.
   */
  public function __toString() {
    if(empty($this->comments)) {
      return "Det finns inga kommentarer.";
    }
    return "<pre>" . htmlentities(print_r($this->comments, 1)) . "</pre>";
  }



  /**
   * Find all comments in Session.
   *
   * @return self to allow chaining of methods.
   */
  protected function findAllFromSession() {
    $this->comments = isset($_SESSION[$this->options['session-key']]['comments']) ? $_SESSION[$this->options['session-key']]['comments'] : array();
    return $this;
  }



  /**
   * Find all comments.
   *
   * @return self to allow chaining of methods.
   */
  public function findAll() {
    return $this->findAllFromSession();
  }



  /**
   * Find all comments related to key.
   *
   * @param string $key optional send key to load, else use key as defined in $this->options.
   * @return self to allow chaining of methods.
   */
  public function findAllByKey($key = null) {
    // Load all comments and remove those not matching the key
    $key = isset($key) ? $key : $this->options['key'];
    $this->findAll();
    foreach($this->comments as $akey => $val) {
      if($key != $val['key']) {
        unset($this->comments[$akey]);
      }
    }
    return $this;
  }



  /**
   * Find all comments.
   *
   * @return true if succedded, else false.
   */
  public function deleteAll() {
    $_SESSION[$this->options['session-key']]['comments'] = array();
    return true;
  }



  /**
   * Save/create a comment.
   *
   * @param array $data to use when saving the comment.
   * @return self to allow chaining of methods.
   */
  public function save($data = array()) {
    $this->data['key'] = $this->options['key'];
    $this->data = array_merge($this->data, $data);
    $this->data['created'] = time();
    $_SESSION[__CLASS__]['comments'][] = $this->data;
    return true;
  }



  /**
   * Check if there is some comments loaded.
   *
   * @return boolean true if there are comments, false otherwise.
   */
  public function isEmpty() {
    return empty($this->comments);
  }



}
