var WebpopParser = Editor.Parser = (function() {

    if (!(CSSParser && JSParser && XMLParser))
        throw new Error("CSS, JS, and XML parsers must be loaded for Webpop parser to work.");
    XMLParser.configure({useHTMLKludges: true});

    function parseWebpop(stream)
    {
        var htmlParser = XMLParser.make(stream), inPop = false;   // , localParser = null, inTag = false;
        var iter = {next: next, copy: copy, context: context};

        function context()
        {
          return htmlParser.context();
        }

        function next()
        {
            var token = htmlParser.next();

            if ((token.content == "<") || (token.content == "</")) {
                if (stream.lookAhead("fc:")) {
                    token.style = "pop-starttag";
                    inPop = true;
                }
            }

            else if (inPop && ((token.content == ">") || (token.content == "/>"))) {
                token.style = "pop-endtag pop";
                inPop = false;
            }

            else if ((token.style == "xml-tagname") && inPop) {
                token.style = "pop-tagname";
            }

            if (inPop) {
                switch (token.style) {
                    case "xml-attname":     token.style = "pop-attname"; break;
                    case "xml-punctuation": token.style = "pop-punctuation"; break;
                    case "xml-attribute":   token.style = "pop-attribute"; break;
                }
                token.style += " pop";
            }
            return token;
        }

        function copy()
        {
            var _html = htmlParser.copy(),  // _local = localParser && localParser.copy(),
                _next = iter.next,
                _inPop = inPop;
            return function(_stream) {
                stream = _stream;
                htmlParser = _html(_stream);
                // localParser = _local && _local(_stream);
                iter.next = _next;
                inPop = _inPop;
                return iter;
            };
        }
        return iter;
    }

    return {make: parseWebpop, electricChars: "{}/:"};
})();
