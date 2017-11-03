
<script src='https://cdnjs.cloudflare.com/ajax/libs/react/15.0.2/react.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js'></script>
<script src='/kaplan3/js/vnjwqb.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/seedrandom/2.4.2/lib/alea.js'></script>

<script>
'use strict';

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

function getLastPath() {
    var rLastPath = /\/([a-zA-Z0-9._]+)(?:\?.*)?$/;
    return rLastPath.test(url) && RegExp.$1; 
}
var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
var segment_array = segment_str.split( '/' );
var last_segment = segment_array[segment_array.length - 1];


$.get("<?php echo site_url("dentist/get_kaplan3/") ?>" +"/" + last_segment , function(data) {
	// if any files already in server show all here
	
var t_data_1 = [];
var t_data_2 = [];

	if (data.length > 0) {
		
		$.each(data, function(key, value) {
			var mockFile = value;

			if(value.material != null)
			{
			

				if( value.material == "3M Singlebond Universal" ){
					if ( value.time != null )
					{
						 t_data_1.push([parseInt(value.time), parseInt(value.death)]);
					} 
				}

				if( value.material == "GC G-Premio bond Universal" ){
					if ( value.time != null )
					{
						 t_data_2.push([parseInt(value.time), parseInt(value.death)]);
					} 
				}

			}


		});
	}

	




var sampleData = [
	{
	  label: '3M Singlebond Universal',
	  data: t_data_1
	},
	{
	  label: 'GC G-Premio bond Universal',
	  data: t_data_2
	}
];

/*
  var sampleData = [
    {
      label: 'group 1',
      data: [ // [time:number, status:(1 = event of interest, 0 = censored)]
        [0, 1],
        [2, 0]
      ]
    }, {
      label: 'group 2',
      data: [
        [0, 1],
        [5, 1]
      ]
    }
  ];
  */

/*
var rng = alea(5625463739);
var sampleData = 'alpha bravo charlie delta'.split(' ').map(function (label) {
  var data = [];
  var sampleSize = ~ ~(rng() * 100);
  var maxTime = ~ ~(rng() * 100);
  for (var index = 0; index < sampleSize; index++) {
    var time = ~ ~(rng() * maxTime);
    var status = ~ ~(rng() * 10) % 2;
    data.push([time, status]);
  }
  return {
    data: data,
    label: label
  };
});
*/
setTimeout(function () {
  var KaplanMeierChart = require('components/charts/KaplanMeier');
  ReactDOM.render(React.createElement(KaplanMeierChart, {
    data: sampleData,
    height: 480,
    width: 600,
    xAxisLabel: 'Time',
    yAxisLabel: 'Probability Percent'
  }), document.getElementById('js-app'));
}, 0);

// BEGIN CHARTS
define('components/charts/Base', function (module) {
  var Base = function (_React$Component) {
    _inherits(Base, _React$Component);

    function Base() {
      _classCallCheck(this, Base);

      return _possibleConstructorReturn(this, _React$Component.apply(this, arguments));
    }

    Base.prototype.render = function render() {
      return React.createElement(
        'svg',
        {
          height: this.props.height,
          width: this.props.width
        },
        this.props.children
      );
    };

    return Base;
  }(React.Component);

  Base.propTypes = {
    width: React.PropTypes.number.isRequired,
    height: React.PropTypes.number.isRequired
  };

  module.exports = Base;
});

define('components/charts/KaplanMeier', function (module) {
  var Base = require('components/charts/Base');
  var KaplanMeierSeries = require('components/charts/KaplanMeierSeries');
  var XAxis = require('components/charts/XAxis');
  var YAxis = require('components/charts/YAxis');
  var Legend = require('components/charts/Legend');

  var KaplanMeier = function (_React$Component2) {
    _inherits(KaplanMeier, _React$Component2);

    function KaplanMeier(props) {
      _classCallCheck(this, KaplanMeier);

      var _this2 = _possibleConstructorReturn(this, _React$Component2.call(this, props));

      _this2.state = {
        disabledGroups: {}
      };
      _this2._onToggleGroup = _this2._onToggleGroup.bind(_this2);
      return _this2;
    }

    KaplanMeier.prototype.findMaxTime = function findMaxTime(groups) {
      return groups.reduce(function (p, _ref) {
        var data = _ref.data;
        return Math.max(p, d3.max(data, function (_ref2) {
          var time = _ref2[0];
          return time;
        }));
      }, -Infinity);
    };

    KaplanMeier.prototype.findMinProbability = function findMinProbability(groups) {
      return groups.reduce(function (p, _ref3) {
        var data = _ref3.data;
        return Math.min(p, d3.min(data, function (_ref4) {
          var probability = _ref4.probability;
          return probability;
        }));
      }, 1);
    };

    KaplanMeier.prototype.calculateProbibilities = function calculateProbibilities(groups) {
      return groups.map(function (_ref5) {
        var label = _ref5.label;
        var data = _ref5.data;

        var lastProb = undefined;
        var probibilities = data.map(function (_ref6, index) {
          var time = _ref6[0];
          var status = _ref6[1];
          var size = _ref6[2];

          var interval = 1 - status / size;
          var probability = index ? lastProb * interval : interval;
          lastProb = probability;
          return {
            probability: probability,
            status: status,
            time: time
          };
        });
        return {
          label: label,
          data: probibilities
        };
      });
    };

    KaplanMeier.prototype.countData = function countData(groups) {
      return groups.map(function (group) {
        var data = group.data;

        var newData = data.slice(0);
        newData.sort(function (_ref7, _ref8) {
          var a = _ref7[0];
          var b = _ref8[0];
          return b - a;
        }); // is now reverse of what it should be
        var size = 1;
        newData = newData.map(function (_ref9) {
          var time = _ref9[0];
          var status = _ref9[1];

          size += 1;
          return [time, status, size];
        });
        var outputGroup = Object.assign({}, group);
        delete outputGroup.data;
        return _extends({}, outputGroup, {
          data: newData.reverse()
        });
      });
    };

    KaplanMeier.prototype._onToggleGroup = function _onToggleGroup(label) {
      var disabledGroups = Object.assign({}, this.state.disabledGroups);
      if (disabledGroups[label]) {
        delete disabledGroups[label];
      } else {
        disabledGroups[label] = true;
      }
      this.setState({ disabledGroups: disabledGroups });
    };

    KaplanMeier.prototype.render = function render() {
      var data = this.props.data;

      var labels = data.map(function (_ref10) {
        var label = _ref10.label;
        return label;
      });
      var maxT = this.findMaxTime(data);
      var xDomain = [0, maxT];
      var colors = d3.scale.category10().range();
      var countedData = this.countData(data);
      var dataSeries = this.calculateProbibilities(countedData);
      var minProbability = this.findMinProbability(dataSeries);
      var yDomain = [1, minProbability];
      return React.createElement(
        Base,
        this.props,
        React.createElement(XAxis, {
          domain: xDomain,
          height: 32,
          label: this.props.xAxisLabel,
          left: 48,
          top: this.props.height - 32,
          width: this.props.width - 64
        }),
        React.createElement(YAxis, {
          domain: [yDomain[0] * 100, yDomain[1] * 100],
          height: this.props.height - 64,
          label: this.props.yAxisLabel,
          left: 32,
          top: 16,
          width: 32
        }),
        React.createElement(KaplanMeierSeries, {
          colors: colors,
          data: dataSeries,
          disabledGroups: this.state.disabledGroups,
          xDomain: xDomain,
          yDomain: yDomain,
          height: this.props.height - 64,
          left: 48,
          top: 16,
          width: this.props.width - 64
        }),
        React.createElement(Legend, {
          colors: colors,
          disabledGroups: this.state.disabledGroups,
          labels: labels,
          left: this.props.width - 32,
          toggleGroup: this._onToggleGroup,
          top: 32
        })
      );
    };

    return KaplanMeier;
  }(React.Component);

  KaplanMeier.propTypes = {
    data: React.PropTypes.array.isRequired,
    height: React.PropTypes.number.isRequired,
    width: React.PropTypes.number.isRequired,
    xAxisLabel: React.PropTypes.string.isRequired,
    yAxisLabel: React.PropTypes.string.isRequired
  };

  module.exports = KaplanMeier;
});

define('components/charts/KaplanMeierSeries', function (module) {
  var KaplanMeierCurve = require('components/charts/KaplanMeierCurve');

  var KaplanMeierSeries = function (_React$Component3) {
    _inherits(KaplanMeierSeries, _React$Component3);

    function KaplanMeierSeries() {
      _classCallCheck(this, KaplanMeierSeries);

      return _possibleConstructorReturn(this, _React$Component3.apply(this, arguments));
    }

    KaplanMeierSeries.prototype.buildCurves = function buildCurves(groups, disabledGroups) {
      var _this4 = this;

      return groups.map(function (group, index) {
        if (disabledGroups[group.label]) {
          return null;
        };
        return React.createElement(KaplanMeierCurve, _extends({
          color: _this4.props.colors[index],
          xDomain: _this4.props.xDomain,
          yDomain: _this4.props.yDomain,
          height: _this4.props.height,
          key: index,
          width: _this4.props.width
        }, group));
      });
    };

    KaplanMeierSeries.prototype.render = function render() {
      return React.createElement(
        'g',
        { transform: 'translate(' + this.props.left + ', ' + this.props.top + ')' },
        this.buildCurves(this.props.data, this.props.disabledGroups)
      );
    };

    return KaplanMeierSeries;
  }(React.Component);

  KaplanMeierSeries.propTypes = {
    colors: React.PropTypes.array.isRequired,
    xDomain: React.PropTypes.array.isRequired,
    yDomain: React.PropTypes.array.isRequired,
    data: React.PropTypes.array.isRequired,
    disabledGroups: React.PropTypes.object.isRequired,
    height: React.PropTypes.number.isRequired,
    left: React.PropTypes.number.isRequired,
    top: React.PropTypes.number.isRequired,
    width: React.PropTypes.number.isRequired
  };

  module.exports = KaplanMeierSeries;
});

define('components/charts/KaplanMeierCurve', function (module) {
  var d3Utils = require('d3Utils');

  var KaplanMeierCurve = function (_React$Component4) {
    _inherits(KaplanMeierCurve, _React$Component4);

    function KaplanMeierCurve() {
      _classCallCheck(this, KaplanMeierCurve);

      return _possibleConstructorReturn(this, _React$Component4.apply(this, arguments));
    }

    KaplanMeierCurve.prototype.collectCensorPoints = function collectCensorPoints(data) {
      return data.filter(function (_ref11) {
        var status = _ref11.status;
        return !status;
      });
    };

    KaplanMeierCurve.prototype.generateLineFunction = function generateLineFunction(xScale, yScale) {
      return d3.svg.line().x(function (_ref12) {
        var time = _ref12.time;
        return xScale(time);
      }).y(function (_ref13) {
        var probability = _ref13.probability;
        return yScale(probability);
      }).interpolate('step-before');
    };

    KaplanMeierCurve.prototype.buildCensorMarks = function buildCensorMarks(censorPoints, xScale, yScale, color) {
      var size = 6;
      var offset = 0 - size / 2;
      return censorPoints.map(function (_ref14, index) {
        var time = _ref14.time;
        var probability = _ref14.probability;
        return React.createElement('rect', {
          height: size,
          key: index,
          opacity: 0.7,
          stroke: color,
          style: { fill: color },
          transform: 'translate(' + offset + ', ' + offset + ')',
          width: size,
          x: xScale(time),
          y: yScale(probability)
        });
      });
    };

    KaplanMeierCurve.prototype.render = function render() {
      var _props = this.props;
      var data = _props.data;
      var xDomain = _props.xDomain;
      var yDomain = _props.yDomain;
      var color = _props.color;

      var xScale = d3Utils.createLinearScale([0, this.props.width], xDomain);
      var yScale = d3Utils.createLinearScale([0, this.props.height], yDomain);
      var lineFunction = this.generateLineFunction(xScale, yScale);
      var censorPoints = this.collectCensorPoints(data);
      return React.createElement(
        'g',
        null,
        React.createElement('path', {
          d: lineFunction(data),
          fill: 'none',
          opacity: 0.7,
          stroke: color,
          strokeWidth: 3
        }),
        this.buildCensorMarks(censorPoints, xScale, yScale, color)
      );
    };

    return KaplanMeierCurve;
  }(React.Component);

  module.exports = KaplanMeierCurve;
});

define('components/charts/YAxis', function (module) {
  var d3Utils = require('d3Utils');

  var YAxis = function (_React$Component5) {
    _inherits(YAxis, _React$Component5);

    function YAxis() {
      _classCallCheck(this, YAxis);

      return _possibleConstructorReturn(this, _React$Component5.apply(this, arguments));
    }

    YAxis.prototype.render = function render() {
      var scale = d3Utils.createLinearScale([0, this.props.height], this.props.domain);
      var yAxis = d3Utils.createAxis(scale, 'left');
      return React.createElement(
        'g',
        {
          className: 'axis axis-y',
          transform: 'translate(' + this.props.left + ', ' + this.props.top + ')'
        },
        React.createElement('g', { dangerouslySetInnerHTML: d3Utils.createAxisMarkup(yAxis, this.props.width, this.props.height) }),
        React.createElement(
          'text',
          {
            dy: '0.71em',
            style: { textAnchor: 'middle' },
            transform: 'rotate(-90)',
            x: -this.props.height / 2,
            y: 6
          },
          this.props.label
        )
      );
    };

    return YAxis;
  }(React.Component);

  YAxis.propTypes = {
    domain: React.PropTypes.array.isRequired,
    height: React.PropTypes.number.isRequired,
    left: React.PropTypes.number.isRequired,
    top: React.PropTypes.number.isRequired,
    width: React.PropTypes.number.isRequired
  };

  module.exports = YAxis;
});

define('components/charts/XAxis', function (module) {
  var d3Utils = require('d3Utils');

  var XAxis = function (_React$Component6) {
    _inherits(XAxis, _React$Component6);

    function XAxis() {
      _classCallCheck(this, XAxis);

      return _possibleConstructorReturn(this, _React$Component6.apply(this, arguments));
    }

    XAxis.prototype.render = function render() {
      var scale = d3Utils.createLinearScale([0, this.props.width], this.props.domain);
      var xAxis = d3Utils.createAxis(scale, 'bottom');
      return React.createElement(
        'g',
        {
          className: 'axis axis-x',
          transform: 'translate(' + this.props.left + ', ' + this.props.top + ')'
        },
        React.createElement('g', { dangerouslySetInnerHTML: d3Utils.createAxisMarkup(xAxis, this.props.width, this.props.height) }),
        React.createElement(
          'text',
          {
            className: 'label',
            style: { textAnchor: 'middle' },
            x: this.props.width / 2,
            y: '-6'
          },
          this.props.label
        )
      );
    };

    return XAxis;
  }(React.Component);

  XAxis.propTypes = {
    domain: React.PropTypes.array.isRequired,
    height: React.PropTypes.number.isRequired,
    left: React.PropTypes.number.isRequired,
    top: React.PropTypes.number.isRequired,
    width: React.PropTypes.number.isRequired
  };

  module.exports = XAxis;
});

define('components/charts/Legend', function (module) {
  var Legend = function (_React$Component7) {
    _inherits(Legend, _React$Component7);

    function Legend() {
      _classCallCheck(this, Legend);

      return _possibleConstructorReturn(this, _React$Component7.apply(this, arguments));
    }

    Legend.prototype._onClick = function _onClick(label) {
      var _this9 = this;

      return function (e) {
        _this9.props.toggleGroup(label);
      };
    };

    Legend.prototype.buildLabels = function buildLabels(labels) {
      var _this10 = this;

      return labels.map(function (label, index) {
        var fill = _this10.props.colors[index];
        if (_this10.props.disabledGroups[label]) {
          fill = 'transparent';
        }
        return React.createElement(
          'g',
          {
            className: 'legend__item',
            key: index,
            onClick: _this10._onClick(label),
            transform: 'translate(' + 0 + ', ' + index * 24 + ')'
          },
          React.createElement(
            'text',
            {
              dy: '0.35em',
              style: { textAnchor: 'left', userSelect: 'none', textAnchor: 'end' },
              y: 8,
              x: -8
            },
            label
          ),
          React.createElement('rect', {
            height: 16,
            stroke: _this10.props.colors[index],
            style: { fill: fill },
            width: 16
          })
        );
      });
    };

    Legend.prototype.render = function render() {
      return React.createElement(
        'g',
        {
          className: 'legend',
          transform: 'translate(' + this.props.left + ', ' + this.props.top + ')'
        },
        this.buildLabels(this.props.labels)
      );
    };

    return Legend;
  }(React.Component);

  Legend.propTypes = {
    colors: React.PropTypes.array.isRequired,
    disabledGroups: React.PropTypes.object.isRequired,
    labels: React.PropTypes.array.isRequired,
    left: React.PropTypes.number.isRequired,
    toggleGroup: React.PropTypes.func.isRequired,
    top: React.PropTypes.number.isRequired
  };

  module.exports = Legend;
});
// END CHARTS

define('d3Utils', function (module) {
  var d3Utils = {
    createAxis: function createAxis(scale, orientation) {
      return d3.svg.axis().scale(scale).orient(orientation);
    },

    createLinearScale: function createLinearScale(range, domain) {
      return d3.scale.linear().range(range).domain(domain);
    },

    createAxisMarkup: function createAxisMarkup(axis, width, height) {
      // refactor, this is an insane hack
      var svg = d3.select('body').append('svg');
      svg.remove();
      svg.attr('width', width);
      svg.attr('height', height);
      var g = svg.append('g');
      g.call(axis);
      var html = g.node().innerHTML;
      return { __html: html };
    }
  };

  module.exports = d3Utils;
});

});

</script>

