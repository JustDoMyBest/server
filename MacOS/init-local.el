;;; init-local.el --- Configure default local -*- lexical-binding: t -*-
;;; Commentary:
;;; Code:

;;start 设置剪切板共享
(defun copy-from-osx ()
  (shell-command-to-string "pbpaste"))
(defun paste-to-osx (text &optional push)
  (let ((process-connection-type nil))
    (let ((proc (start-process"pbcopy" "*Messages*" "pbcopy")))
      (process-send-string proc text)
      (process-send-eof proc))))
(setq interprogram-cut-function 'paste-to-osx)
(setq interprogram-paste-function 'copy-from-osx)
;;end 设置剪切板共享

(provide 'init-local)
;;; init-local.el ends here