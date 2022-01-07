## 编码须知

- 本项目使用 PHP 8.0 语法
- 本项目已引入`hrb981027/treasure-bag`包，使用统一的异常处理器`\Hrb981027\TreasureBag\Exception\Handler\StandardExceptionHandler::class`，并返回统一的响应体
- 使用`composer cs-fix [path]`命令来格式化代码，格式化配置请查看`.php-cs-fixer.php`文件，请在提交代码前格式化文件
- 数据库表前缀请使用以下划线分隔的格式，例如`member_service_`
- 本项目已忽略`composer.lock`文件
- 官方热启动命令：`php bin/hyperf.php server:watch`
- 使用了 Monolog 日志系统，日志目录：`runtime/logs`
- 更新日志使用了`conventional-changelog-cli`自动生成，命令：`conventional-changelog -p angular -i CHANGELOG.md -s` 或者 `npm run changelog`

### 参考

- [hrb981027/treasure-bag](https://github.com/hrb981027/treasure-bag)
- [自动版本化和生成CHANGELOG工具standard-version](https://zj-git-guide.readthedocs.io/zh_CN/stable/message-guideline/%E8%87%AA%E5%8A%A8%E7%89%88%E6%9C%AC%E5%8C%96%E5%92%8C%E7%94%9F%E6%88%90CHANGELOG%E5%B7%A5%E5%85%B7standard-version.html)
