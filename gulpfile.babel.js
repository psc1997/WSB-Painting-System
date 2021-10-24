/* eslint-disable */

import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import del from 'del';
import webpack from 'webpack';
import webpackStream from 'webpack-stream';
import named from 'vinyl-named';
import browserSync from 'browser-sync';
import zip from 'gulp-zip';
import info from './package.json';
import replace from 'gulp-replace';
import wpPot from 'gulp-wp-pot';
import gulpIconfont from 'gulp-iconfont';
import iconfontCss from 'gulp-iconfont-css';
import RevAll from 'gulp-rev-all';
import sassGlob from 'gulp-sass-glob';
import cssimport from "gulp-cssimport";

var plugins = require('gulp-load-plugins')();

const runTimestamp = Math.round(Date.now() / 1000);
const config = require('./gulpconfig.json');

const PRODUCTION = yargs.argv.prod;
const server = browserSync.create();

export const serve = (done) => {
    server.init({
        proxy: 'http://aquanet.local',
    });
    done();
};

export const reload = (done) => {
    server.reload();
    done();
};

export const clean = () => del([config.paths.dest]);

export const fonts = () => {
    return src([config.paths.fonts.src + '/**/*']).pipe(
        dest([config.paths.fonts.dest])
    );
};

export const styles = () => {
    return src([
        config.paths.styles.src + '/main.scss',
        config.paths.styles.src + '/admin.scss',
    ])
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sassGlob())
        .pipe(
            plugins.sass({
                outputStyle: 'expanded',
            })
        )
        .pipe(cssimport())
        .pipe(
            plugins.autoprefixer({
                overrideBrowserslist: [
                    '> 1%',
                    'last 8 versions',
                    'Firefox ESR',
                    'IE 9',
                ],
                cascade: false,
            })
        )
        .pipe(
            gulpif(
                PRODUCTION,
                plugins.cleanCss({
                    compatibility: 'ie8',
                    level: {
                        1: {
                            specialComments: 0,
                        },
                    },
                })
            )
        )
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
        .pipe(gulpif(PRODUCTION, cleanCss({ compatibility: 'ie8' })))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
        .pipe(dest(config.paths.styles.dest))
        .pipe(gulpif(!PRODUCTION, RevAll.revision()))
        .pipe(dest(config.paths.styles.dest))
        .pipe(gulpif(!PRODUCTION, RevAll.manifestFile()))
        .pipe(dest(config.paths.styles.dest))
        .pipe(server.stream());
};

export const img = () => {
    return src(config.paths.images.src + '/**/*.{jpg,jpeg,png,svg,gif}')
        .pipe(gulpif(PRODUCTION, imagemin()))
        .pipe(dest(config.paths.images.dest));
};

export const video = () => {
    return src(config.paths.videos.src + '/**/*.{mp4,webm}')
        .pipe(dest(config.paths.videos.dest));
};

const iconfontMove = () => {
    src([config.paths.iconfont.dest + '/_iconfont.scss'], {
        allowEmpty: true,
    }).pipe(dest(config.paths.styles.src + '/fonts/'));

    return del([config.paths.iconfont.dest + '/_iconfont.scss']);
};

const iconfontGenerate = () => {
    return src(config.paths.iconfont.src + '/*.svg')
        .pipe(
            iconfontCss({
                fontName: 'iconfont',
                path: config.paths.iconfont.src + '/template.scss',
                targetPath: '_iconfont.scss',
                fontPath: '../iconfont/',
            })
        )
        .pipe(
            gulpIconfont({
                fontName: 'iconfont',
                appendCodepoints: true,
                centerHorizontaly: true,
                normalize: true,
                prependUnicode: false,
                fontHeight: 1001,
                formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'],
                timestamp: runTimestamp,
            })
        )
        .pipe(dest(config.paths.iconfont.dest));
};

export const copy = () => {
    return src([
        config.paths.src + '/**/*',
        `!${config.paths.src}/{img,js,scss,iconfont}`,
        `!${config.paths.src}/{img,js,scss,iconfont}/**/*`,
    ]).pipe(dest(config.paths.dest));
};

export const scripts = () => {
    return src([
        config.paths.scripts.src + '/main.js',
        config.paths.src + '/js/admin.js',
    ])
        .pipe(named())
        .pipe(
            webpackStream({
                module: {
                    rules: [
                        {
                            test: /\.js$/,
                            use: {
                                loader: 'babel-loader',
                                options: {
                                    presets: [],
                                },
                            },
                        },
                    ],
                },
                mode: PRODUCTION ? 'production' : 'development',
                devtool: !PRODUCTION ? 'inline-source-map' : false,
                output: {
                    filename: '[name].js',
                },
                externals: {
                    jquery: 'jQuery',
                },
                plugins: [
                    new webpack.ProvidePlugin({
                        $: 'jquery',
                        jQuery: 'jquery',
                        'window.jQuery': 'jquery',
                    }),
                ],
            })
        )
        .pipe(dest(config.paths.scripts.dest))
        .pipe(gulpif(!PRODUCTION, RevAll.revision()))
        .pipe(dest(config.paths.scripts.dest))
        .pipe(gulpif(!PRODUCTION, RevAll.manifestFile()))
        .pipe(dest(config.paths.scripts.dest));
};

export const revisions = () => {
    return src([
        config.paths.styles.dest + '/main.css',
        config.paths.styles.dest + '/admin.css',
        config.paths.scripts.dest + '/main.js',
        config.paths.scripts.dest + '/admin.js',
    ])
        .pipe(RevAll.revision())
        .pipe(dest(config.paths.dest))
        .pipe(RevAll.versionFile())
        .pipe(dest(config.paths.dest))
        .pipe(RevAll.manifestFile())
        .pipe(dest(config.paths.dest));
};

export const compress = () => {
    return src([
        '**/*',
        '!node_modules{,/**}',
        '!bundled{,/**}',
        `!${config.paths.src}{,/**}`,
        '!.babelrc',
        '!.gitignore',
        '!gulpfile.babel.js',
        '!package.json',
        '!package-lock.json',
    ])
        .pipe(
            gulpif(
                (file) => file.relative.split('.').pop() !== 'zip',
                replace('_themename', info.name)
            )
        )
        .pipe(zip(`${info.name}.zip`))
        .pipe(dest('bundled'));
};

export const pot = () => {
    return src(config.paths.root + '/**/*.php')
        .pipe(
            wpPot({
                domain: 'pm_wp',
                package: info.name,
                ignoreTemplateNameHeader: true,
            })
        )
        .pipe(dest(`${config.paths.root}/languages/pm_wp.pot`))
        .pipe(src(config.paths.root + '/**/*.php'))
        .pipe(
            wpPot({
                domain: 'pm_theme',
                package: info.name,
                ignoreTemplateNameHeader: true,
            })
        )
        .pipe(dest(`${config.paths.root}/languages/pm_theme.pot`));
};

export const watchForChanges = () => {
    watch(config.paths.src + '/**/*.scss', styles);
    watch(
        config.paths.images.src + '/**/*.{jpg,jpeg,png,svg,gif}',
        series(img, reload)
    );
    watch(
        [
            config.paths.src + '/**/*',
            `!${config.paths.src}/{img,js,scss}`,
            `!${config.paths.src}/{img,js,scss}/**/*`,
        ],
        series(copy, reload)
    );
    watch(config.paths.iconfont.src + '/**/*.svg', iconfont);
    watch(config.paths.scripts.src + '/**/*.js', series(scripts, reload));
    watch(config.paths.root + '/**/*.php', reload);
};

export const iconfont = series(iconfontGenerate, iconfontMove);

export const dev = series(
    clean,
    iconfontGenerate,
    iconfontMove,
    parallel(styles, img, fonts, copy, scripts, video),
    // revisions,
    watchForChanges
);

export const sync = series(
    clean,
    iconfontGenerate,
    iconfontMove,
    parallel(styles, img, fonts, copy, scripts, video),
    // revisions,
    serve,
    watchForChanges
);

export const build = series(
    clean,
    iconfontGenerate,
    iconfontMove,
    parallel(styles, img, copy, scripts, video),
    // pot,
    // revisions
);

export default dev;
