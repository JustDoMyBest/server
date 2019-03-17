; -*- lexical-binding: t -*-
(progn
(defvar testvar "2222")
(defun test ()
  (let '(letvar "Hello World!!")
;  (let ((letvar 123))
    letvar))

(test)
)


(progn
(setq animals '(gazelle giraffe lion tiger))

(defun reverse-list-with-while (list)
  "Using while, reverse the order of LIST."
  (let (value)  ; make sure list starts empty
    (while list
      (setq value (cons (car list) value))
      (setq list (cdr list)))
    value))

(reverse-list-with-while animals)
)
