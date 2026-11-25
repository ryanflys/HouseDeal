# HouseDeal

> 开箱即用的房产交易网站模板，基于 Laravel 5.4 构建，支持二手房、新房、租房的发布、搜索与管理。

## 功能概览

### 前台功能
- 房源首页展示（精选房源 + 最新房源）
- 房源列表（支持按关键词、类型、状态、价格区间筛选）
- 房源详情页（户型、面积、楼层、经纪人信息、收藏）
- 用户注册 / 登录 / 密码重置
- 用户个人中心（房源统计、最近发布）
- 我的房源管理（发布、编辑、删除）
- 我的收藏管理

### 后台管理
- 仪表盘（房源/用户/经纪人/交易统计、最新动态）
- 房源管理（CRUD、搜索、状态管理）
- 用户管理（列表、编辑、角色分配、删除）
- 经纪人管理（CRUD、搜索）
- 交易管理（列表、状态流转处理）

### 技术特性
- 三角色权限体系（管理员 / 经纪人 / 普通用户）
- 后台路由 `auth` + `admin` 中间件保护
- 软删除（房源、经纪人、交易支持恢复）
- Blade 布局继承，前后台分离
- 搜索筛选 + 分页
- CSRF 保护
- 种子数据开箱即用

## 技术栈

| 类别 | 技术 |
| --- | --- |
| 后端框架 | Laravel 5.4 (PHP >= 5.6.4) |
| 数据库 | MySQL |
| 前端模板 | Blade + Bootstrap 3 + Matrix Admin |
| JS | jQuery 3.x |
| CSS | Bootstrap 3 + Font Awesome |
| 前端构建 | Laravel Mix (Webpack) |

## 项目结构

```
HouseDeal/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # 后台控制器（Index/House/User/Agent/Deal）
│   │   │   ├── Auth/            # 认证控制器
│   │   │   ├── HouseController  # 前台房源控制器
│   │   │   ├── UserController   # 前台用户控制器
│   │   │   └── Controller.php
│   │   ├── Middleware/
│   │   │   ├── CheckAdmin.php   # 管理员权限中间件
│   │   │   └── ...
│   │   └── Kernel.php
│   ├── House.php                # 房产模型
│   ├── Agent.php                # 经纪人模型
│   ├── Deal.php                 # 交易模型
│   └── User.php                 # 用户模型（含角色）
├── database/
│   ├── migrations/              # users / houses / agents / deals / favorites
│   ├── seeds/                   # 完整种子数据
│   └── factories/               # 模型工厂
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php        # 前台布局
│   │   └── admin.blade.php      # 后台布局
│   ├── auth/                    # 登录/注册视图
│   ├── houses/                  # 前台房源视图
│   ├── user/                    # 用户中心视图
│   └── admin/                   # 后台管理视图
├── routes/
│   └── web.php                  # 前台 + 后台 + 认证路由
└── ...
```

## 路由总览

### 前台路由

| 方法 | 路径 | 说明 |
| --- | --- | --- |
| GET | `/` | 首页 |
| GET | `/houses` | 房源列表（支持筛选） |
| GET | `/houses/{id}` | 房源详情 |
| GET | `/login` | 登录 |
| POST | `/login` | 登录提交 |
| GET | `/register` | 注册 |
| POST | `/register` | 注册提交 |
| GET | `/user/dashboard` | 个人中心 |
| GET | `/user/houses` | 我的房源 |
| GET | `/user/houses/create` | 发布房源 |
| POST | `/user/houses` | 保存房源 |
| GET | `/user/favorites` | 我的收藏 |
| POST | `/user/favorites/{id}` | 收藏/取消收藏 |

### 后台路由（需 `auth` + `admin` 中间件）

| 方法 | 路径 | 说明 |
| --- | --- | --- |
| GET | `/admin/index` | 仪表盘 |
| GET | `/admin/houses` | 房源管理 |
| GET | `/admin/users` | 用户管理 |
| GET | `/admin/agents` | 经纪人管理 |
| GET | `/admin/deals` | 交易管理 |

## 环境要求

- PHP >= 5.6.4
- MySQL 5.7+
- Composer
- Node.js & npm

## 快速开始

```bash
# 1. 克隆项目
git clone https://github.com/ryanflys/HouseDeal.git
cd HouseDeal

# 2. 安装 PHP 依赖
composer install

# 3. 安装前端依赖
npm install

# 4. 配置环境
cp .env.example .env
php artisan key:generate

# 5. 编辑 .env，配置数据库连接
#    DB_DATABASE=housedeal
#    DB_USERNAME=your_username
#    DB_PASSWORD=your_password

# 6. 执行数据库迁移 + 填充种子数据
php artisan migrate --seed

# 7. 启动开发服务器
php artisan serve
```

## 默认账号

种子数据包含以下测试账号：

| 角色 | 邮箱 | 密码 |
| --- | --- | --- |
| 管理员 | admin@housedeal.com | admin123 |
| 经纪人 | agent@housedeal.com | agent123 |
| 普通用户 | （随机生成） | secret |

## 后续优化方向

- [ ] 图片上传功能（当前为静态图片路径）
- [ ] 集成地图 API（高德/百度）显示房源位置
- [ ] Laravel Scout + MeiliSearch 全文搜索
- [ ] 消息通知系统（站内信 / 短信 / 邮件）
- [ ] 数据可视化图表（ECharts）
- [ ] API 接口开发（前后端分离支持）
- [ ] 升级到 Laravel 10/11 + PHP 8.2+
- [ ] Docker 部署方案
- [ ] 单元测试 & Feature 测试

## License

MIT
