<?php

/**
 * Lớp CSRF đơn giản để bảo vệ các biểu mẫu chống lại các cuộc tấn công CSRF
 * Sử dụng các phiên PHP để lưu trữ
 */

class CSRF_Protect
{
    /**
     * Lưu trữ tên các biến phiên làm việc và thẻ inputs
     *
     * @var string
     */
    private $namespace;

    /**
     * __construct
     *
     * @param string $namespace
     * 
     */
    public function __construct($namespace = '_csrf')
    {
        $this->namespace = $namespace;
        if (session_id() === '') {
            session_start();
        }
        $this->setToken();
    }

    /**
     * Lấy token từ khu lưu trữ
     * 
     * @return string
     */
    public function getToken()
    {
        return $this->readTokenFromStorage();
    }

    /**
     * Validate token
     *
     * @param  mixed $userToken
     * @return void
     */
    public function isTokenValid($userToken)
    {
        return ($userToken === $this->readTokenFromStorage());
    }

    /**
     * Hiển thị thẻ input có token
     *
     * @return void
     */
    public function echoInputField()
    {
        $token = $this->getToken();
        echo "<input type=\"hidden\" name=\"{$this->namespace}\" value=\"{$token}\" />";
    }

    public function verifyRequest()
    {
        if (!$this->isTokenValid($_POST[$this->namespace])) {
            die("CSRF validation failed.");
        }
    }

    /**
     * Tạo một giá trị mã thông báo mới và lưu trữ nó trong bộ lưu trữ hiện tại
     * hoặc nếu không thì sẽ không làm gì nếu một mã đã tồn tại trong bộ lưu trữ hiện tại
     * 
     */
    private function setToken()
    {
        $storedToken = $this->readTokenFromStorage();
        if ($storedToken === '') {
            $token = md5(uniqid(rand(), TRUE));
            $this->writeTokenToStorage($token);
        }
    }

    /**
     * Đọc mã thông báo từ lưu trữ hiện tại
     * 
     * @return string
     */
    private function readTokenFromStorage()
    {
        if (isset($_SESSION[$this->namespace])) {
            return $_SESSION[$this->namespace];
        } else {
            return '';
        }
    }

    /**
     * Ghi token vào lưu trữ hiện tại
     *
     * @param string $token
     * 
     */
    private function writeTokenToStorage($token)
    {
        $_SESSION[$this->namespace] = $token;
    }
}
