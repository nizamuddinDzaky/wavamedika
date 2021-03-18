var gulp = require('gulp');
var shell = require('gulp-shell');
var runInSequence = require('gulp4-run-sequence');
var change = require('gulp-change');
var replace = require('gulp-replace');
var fs = require('fs');

gulp.task('cp:types', shell.task([
    'cp -r ./typetemporary/* ./node_modules/@types/'
]));

gulp.task('run:start', shell.task([
    '"./node_modules/.bin/react-scripts" start'
]));

gulp.task('run:build', shell.task([
    '"./node_modules/.bin/react-scripts" build'
]));

gulp.task('run:lint', shell.task([
    '"./node_modules/.bin/eslint" ./src'
]));

gulp.task('clean', shell.task([
    'rm -rf ../../fo/*'
]));

gulp.task('mkdir:fo', function(callback) {
    if(!fs.existsSync('../../fo')) {
        fs.mkdirSync('../../fo')
    }

    callback();
});

gulp.task('cp:build', shell.task([
    'cp -rf build/* ../../fo/'
]));

gulp.task('cp:htaccess', shell.task([
    'cp ../../.htaccess ../../fo/.htaccess'
]));

gulp.task('cp:index', shell.task([
    'cp build/index.html ../../application/apps/fo/views/v_fo.php && cp build/index.html ../../fo/index.php && rm -f ../../fo/index.html'
]));

gulp.task('build:check', function (callback) {
    runInSequence('run:lint', callback);
});

gulp.task('build', function (callback) {
    runInSequence('run:build', 'clean', 'mkdir:fo', 'cp:build', 'cp:htaccess', 'cp:index', 'edit:indexPhp', 'edit:precachemanifest', 'edit:assetmanifest', 'edit:service-worker.js', callback);
});


// function setSw(content) {
//     return content.replace(/importScripts(\s+fo/, 'mersi-frontend-react/fo');
// }

// gulp.task('edit:sw', function () {
//     return gulp.src('../../fo/service-worker.js')
//         .pipe(change(setSw))
//         .pipe(gulp.dest('../../fo/'));
// })
//
// function setIndexPhp (content) {
//     return content.replace("');
// }


gulp.task('edit:indexPhp', function () {
    return gulp.src('../../fo/index.php')
        .pipe(replace('/fo/', function() {
            return '<?php echo "http://" . $_SERVER[\'HTTP_HOST\'].preg_replace(\'@/+$@\', \'\', dirname($_SERVER[\'SCRIPT_NAME\'])) . \'/\'; ?>';
        }))
        .pipe(gulp.dest('../../fo/'));
});

gulp.task('edit:precachemanifest', function () {
    return gulp.src('../../fo/precache-manifest.*')
        .pipe(replace('/fo/', function () {
            return '';
        }))
        .pipe(replace('index.html', 'index.php'))
        .pipe(gulp.dest('../../fo/'));
})

gulp.task('edit:assetmanifest', function () {
    return gulp.src('../../fo/asset-manifest.json')
        .pipe(replace('/fo/', function () {
            return '';
        }))
        .pipe(gulp.dest('../../fo/'));
})

gulp.task('edit:service-worker.js', function () {
    return gulp.src('../../fo/service-worker.js')
        .pipe(replace(/importScripts\(\s[  ]{2,}/, function () {
            return 'function getBasename(path) {\n' +
                '    return path.substr(0, path.lastIndexOf(\'/fo\'));\n' +
                '};\n' +
                'var base = getBasename(self.location.pathname)?getBasename(self.location.pathname): \'\';\n' +
                'importScripts(\n' +
                'base+';
        }))
        .pipe(replace(new RegExp(/workbox.routing.registerNavigationRoute\(workbox.precaching.getCacheKeyForURL\("\/fo\/index.html"\)[,\/][  ]{1,}\{/), function () {
            return '';
        }))
        .pipe(replace(new RegExp(/[ ]{2,}blacklist: \[\/\^\\\/_\/,\/\\\/\[\^\\\/\?]\+\\.\[\^\\\/]\+\$\/],\n\}\)\;/g),function () {
            return 'workbox.routing.registerRoute(new RegExp(self.location.hostname+base),  new workbox.strategies.CacheFirst())';
        }))
        // .pipe(replace(/[  ]{2,}blacklist/), function () {
        //     return '//blacklist';
        // })
        .pipe(gulp.dest('../../fo/'));
});



gulp.task('start', function (callback) {
    runInSequence('run:start', callback);
});
