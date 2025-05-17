<?php
/**
 * Renders the contact form block on the frontend.
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$inputHeight             = $attributes["inputHeight"];
$inputGap               = $attributes["inputGap"];
$labelFontSize          = $attributes["labelFontSize"];
$inputFontSize          = $attributes["inputFontSize"];
$inputPadding           = $attributes["inputPadding"];
$inputMarginTop         = $attributes["inputMarginTop"];
$buttonFontSize         = $attributes["buttonFontSize"];
$buttonPadding          = $attributes["buttonPadding"];
$buttonTextColor        = $attributes["buttonTextColor"];
$buttonBackgroundColor  = $attributes["buttonBackgroundColor"];
$textareaHeight         = $attributes["textareaHeight"];

$nameLabel    = $attributes["nameLabel"];
$subjectLabel = $attributes["subjectLabel"];
$emailLabel   = $attributes["emailLabel"];
$messageLabel = $attributes["messageLabel"];

// Generate math challenge
$num1 = rand(1, 10);
$num2 = rand(1, 10);
$answer = $num1 + $num2;
$questionText = "$num1 + $num2";
?>

<div class="larris-contact-form" <?php echo get_block_wrapper_attributes(); ?>>
    <form id="formData" class="contact-form__form" method="post">
        <ul class="contact-form__list">
            <li class="contact-form__item" >
                <label class="contact-form__label" for="userName"><?php echo esc_html($nameLabel); ?></label>
                <input class="contact-form__input" type="text" id="userName" name="userName" required />
            </li>

            <li class="contact-form__item" >
                <label class="contact-form__label"  for="userSubject"><?php echo esc_html($subjectLabel); ?></label>
                <input class="contact-form__input" type="text" id="userSubject" name="userSubject" required />
            </li>

            <li class="contact-form__item" >
                <label class="contact-form__label" for="userEmail"><?php echo esc_html($emailLabel); ?></label>
                <input class="contact-form__email" type="email" id="userEmail" name="userEmail" required />
            </li>

            <li class="contact-form__item" >
                <label class="contact-form__label" ><?php echo esc_html($messageLabel); ?></label>
                <textarea class="contact-form__textarea" name="userMessage" id="userMessage" required></textarea>
            </li>

            <li class="contact-form__item" >
                <label class="contact-form__label"  for="user-answer">What is <span id="math-question"><?php echo esc_html($questionText); ?></span>?</label>
                <input class="contact-form__input" id="user-answer" class="larris-contact-form__input" type="number" name="ccf_math" required />
                <input id="answer-key" type="hidden" name="ccf_math_answer" value="<?php echo esc_attr($answer); ?>" />
                <p id="warning-input" style="color: red; display: none;">Incorrect answer. Please try again.</p>
            </li>

            <li class="contact-form__button_container" >
                <button type="submit" id="submitBtn" class="contact-form__button">Submit</button>
            </li>
            <input type="hidden" name="ccf_nonce" value="<?php echo wp_create_nonce('ccf_form_nonce'); ?>">
            <input type="text" name="ccf_honeypot" value="" style="display:none;">
        </ul>
    </form>

    <div id="ccf-response" class="larris-contact-form-response"></div>
</div>

<script>
    const ajaxurl = "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("formData");
        const warningEl = document.getElementById("warning-input");
        const responseElement = document.getElementById("ccf-response");
        const submitButton = document.querySelector("#submitBtn");

        if (!form || !warningEl || !responseElement || !submitButton) {
            console.error("❌ Required elements not found!");
            return;
        }

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            if (!checkUserAnswer()) {
                console.log("❌ Incorrect answer. Showing warning.");
                warningEl.style.display = "block";
                return;
            }

            console.log("✅ Correct answer submitted.");
            warningEl.style.display = "none";
            submitButton.disabled = true;

            const formData = new FormData(form);
            formData.append("action", "custom_contact_form_handler");

            fetch(ajaxurl, {
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then(({success, data}) => {
                console.log(data)

                if (!success || data.status !== "success") {
                console.error("❌ Server error:", data);
                responseElement.innerHTML = "An error occurred. Please try again later.";
                return;
            }

            const {message, new_question, new_answer } = data

            responseElement.innerHTML = message;

            // Reload the math question with new numbers
            reloadMathQuestion(new_question, new_answer);

            // Optionally reset the form fields if desired
            form.reset();

            submitButton.disabled = false; // Re-enable button


            })
            .catch(error => {
                console.error("❌ Fetch error:", error);
                responseElement.innerHTML = "An error occurred. Please try again later.";
                submitButton.disabled = false;
            });
        });
    });

    function checkUserAnswer() {
        const userAnswerEl = document.getElementById("user-answer");
        const answerKeyEl = document.getElementById("answer-key");

        if (!userAnswerEl || !answerKeyEl) return false;

        return userAnswerEl.value.trim() === answerKeyEl.value.trim();
    }

    function reloadMathQuestion(question, answer) {
        const mathQuestionEl = document.getElementById("math-question");
        const answerKeyEl = document.getElementById("answer-key");
        const userAnswerEl = document.getElementById("user-answer");
        const warningEl = document.getElementById("warning-input");

        if (!mathQuestionEl || !answerKeyEl || !userAnswerEl || !warningEl) return;

        mathQuestionEl.innerText = question;
        answerKeyEl.value = answer;
        userAnswerEl.value = "";
        warningEl.style.display = "none";
        userAnswerEl.focus();
    }
</script>
