<?php
session_start();
include 'condb.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลที่ส่งมาจากหน้า order-details.php
    $product_id = $_POST['product_id'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    // แสดงข้อมูลที่รับมา
    // echo "<h2>ยืนยันการชำระเงิน</h2>";
    // echo "<p>ชื่อสินค้า: $product_description</p>";
    // echo "<p>จำนวน: $quantity</p>";
    // echo "<p>ราคาต่อชิ้น: ฿" . number_format($product_price, 2) . "</p>";
    // echo "<p>ยอดรวมทั้งหมด: ฿" . number_format($total_price, 2) . "</p>";

    // จากนั้นคุณสามารถเพิ่มฟอร์มสำหรับการกรอกข้อมูลบัตรเครดิตและดำเนินการชำระเงินในหน้านี้
}

if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
  $product_id = intval($_POST['product_id']);
  $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
} else {
  echo "No product found.";
  exit;
}

$sql = "SELECT * FROM product WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $product = $result->fetch_assoc();
  $total_price = $product['product_price'] * $quantity;
} else {
  echo "No product found.";
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment option</title>
    <!-- Credit Card Form CSS -->
    <link rel="stylesheet" href="Css/card-option V2.css">
    <!-- <script src="JS/card-option V2.js"></script> -->
  </head>
  <body>
  
 <main>
<!-- Credit Card From HTML -->
<div class="wrapper" id="app">
    <div class="card-form">
      <div class="card-list">
        <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
          <div class="card-item__side -front">
            <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
            <div class="card-item__cover">
              <img
              v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
            </div>
            
            <div class="card-item__wrapper">
              <div class="card-item__top">
                <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip">
                <div class="card-item__type">
                  <transition name="slide-fade-up">
                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" v-bind:key="getCardType" alt="" class="card-item__typeImg">
                  </transition>
                </div>
              </div>
              <label for="cardNumber" class="card-item__number" ref="cardNumber">
                <template v-if="getCardType === 'amex'">
                 <span v-for="(n, $index) in amexCardMask" :key="$index">
                  <transition name="slide-fade-up">
                    <div
                      class="card-item__numberItem"
                      v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''"
                    >*</div>
                    <div class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      :key="$index" v-else-if="cardNumber.length > $index">
                      {{cardNumber[$index]}}
                    </div>
                    <div
                      class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      v-else
                      :key="$index + 1"
                    >{{n}}</div>
                  </transition>
                </span>
                </template>

                <template v-else>
                  <span v-for="(n, $index) in otherCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div
                        class="card-item__numberItem"
                        v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''"
                      >*</div>
                      <div class="card-item__numberItem"
                        :class="{ '-active' : n.trim() === '' }"
                        :key="$index" v-else-if="cardNumber.length > $index">
                        {{cardNumber[$index]}}
                      </div>
                      <div
                        class="card-item__numberItem"
                        :class="{ '-active' : n.trim() === '' }"
                        v-else
                        :key="$index + 1"
                      >{{n}}</div>
                    </transition>
                  </span>
                </template>
              </label>
              <div class="card-item__content">
                <label for="cardName" class="card-item__info" ref="cardName">
                  <div class="card-item__holder">Card Holder</div>
                  <transition name="slide-fade-up">
                    <div class="card-item__name" v-if="cardName.length" key="1">
                      <transition-group name="slide-fade-right">
                        <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')" v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                      </transition-group>
                    </div>
                    <div class="card-item__name" v-else key="2">Full Name</div>
                  </transition>
                </label>
                <div class="card-item__date" ref="cardDate">
                  <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                  <label for="cardMonth" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                      <span v-else key="2">MM</span>
                    </transition>
                  </label>
                  /
                  <label for="cardYear" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-if="cardYear" v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                      <span v-else key="2">YY</span>
                    </transition>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="card-item__side -back">
            <div class="card-item__cover">
              <img
              v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
            </div>
            <div class="card-item__band"></div>
            <div class="card-item__cvv">
                <div class="card-item__cvvTitle">CVV</div>
                <div class="card-item__cvvBand">
                  <span v-for="(n, $index) in cardCvv" :key="$index">
                    *
                  </span>

              </div>
                <div class="card-item__type">
                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg">
                </div>
            </div>
          </div>
        </div>
      </div>

      <form action="payment-success.php" method="POST" autocomplete="on">
      <div class="card-form__inner">
        <h3>Credit Card information</h3>
        <div class="card-input">
  <label for="cardNumber" class="card-input__label">Card Number</label>
  <input type="text" id="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="cc-number">
</div>

<div class="card-input">
  <label for="cardName" class="card-input__label">Card Holders</label>
  <input type="text" id="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="cc-name">
</div>

<div class="card-form__row">
  <div class="card-form__col">
    <div class="card-form__group">
      <label for="cardMonth" class="card-input__label">Expiration Date</label>
      <select class="card-input__input -select" id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate" autocomplete="cc-exp-month">
        <option value="" disabled selected>Month</option>
        <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12" v-bind:disabled="n < minCardMonth" v-bind:key="n">
          {{n < 10 ? '0' + n : n}}
        </option>
      </select>
      <select class="card-input__input -select" id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate" autocomplete="cc-exp-year">
        <option value="" disabled selected>Year</option>
        <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12" v-bind:key="n">
          {{$index + minCardYear}}
        </option>
      </select>
    </div>
  </div>

  <div class="card-form__col -cvv">
    <div class="card-input">
      <label for="cardCvv" class="card-input__label">CVV</label>
      <input type="text" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="4" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off">
    </div>
  </div>
</div>


<!-- ฟอร์มส่งข้อมูลการสั่งซื้อ -->

  <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
  <input type="hidden" name="product_description" value="<?php echo $product['product_description']; ?>">
  <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
  <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
  <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
  <button type="submit" class="card-form__button" onclick="alertUser()">จ่ายตอนนี้</button>
</form>


      </div>
    </div>
    

  </div>
<!-- END Credit Card From HTML -->
 </main>
 
<!-- Vue JS -->  
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<!-- Vue Mask JS -->
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
<!-- Credit Card Form JS -->
<script src="JS/card-option V2.js"></script>
  </body>
</html>