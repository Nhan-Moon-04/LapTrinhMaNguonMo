<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

</head>

<body>

    <?php
    // Định nghĩa class BankAccount
    class BankAccount
    {
        private $accountNumber;
        private $ownerName;
        private $balance;

        public function __construct($accountNumber, $ownerName, $balance = 0)
        {
            $this->accountNumber = $accountNumber;
            $this->ownerName = $ownerName;
            $this->balance = $balance;
        }

        public function deposit($amount)
        {
            if ($amount > 0) {
                $this->balance += $amount;
                echo "Đã nạp $amount vào tài khoản.<br>";
            } else {
                echo "Số tiền nạp phải lớn hơn 0.<br>";
            }
        }

        public function withdraw($amount)
        {
            if ($amount > 0) {
                if ($amount <= $this->balance) {
                    $this->balance -= $amount;
                    echo "Đã rút $amount khỏi tài khoản.<br>";
                } else {
                    echo "Số dư không đủ để rút $amount.<br>";
                }
            } else {
                echo "Số tiền rút phải lớn hơn 0.<br>";
            }
        }

        public function displayBalance()
        {
            echo "Số dư hiện tại của {$this->ownerName} là: <b>{$this->balance}</b><br>";
        }
    }

    // --- Chạy thử ---
    $account = new BankAccount("16112004", "Nguyễn Thiện Nhân", 1000000);
    $account->displayBalance();

    $account->deposit(500000);
    $account->withdraw(200000);
    $account->withdraw(2000000);

    $account->displayBalance();
    ?>
</body>

</html>