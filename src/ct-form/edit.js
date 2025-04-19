/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

import {useState, } from "@wordpress/element";
import {TextControl ,PanelBody} from "@wordpress/components"


export default function Edit(props) {

	const [name, setName] = useState("John Doe");
	const [subject, setSubject] = useState("Meeting Invitation")
	const [email, setEmail] = useState("John@johndoe.com")
	const [message, setMessage] = useState("This is example of message form.")

	const {attributes, setAttributes} = props
	const {
		textareaHeight,
		inputGap, 
		inputFontSize,
		labelFontSize, 
		inputPadding, 
		inputMarginTop,
		nameLabel,
		subjectLabel,
		emailLabel,
		messageLabel
	} = attributes;



	const handleInputGap = (value) => {
		setAttributes({inputGap: value})
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title="Form Settings" initialOpen={true}>
					<TextControl
						label="Email Recipent"
						value=""
					/>
					<p>Learn how to set up and style the contact form and configure SMTP by reading the documentation: <a href='#' target='_blank' >View Guide</a></p>					
					<TextControl
						label="Email Subject"
						value=""
					/>
					<p>This subject will appear in the email you receive when someone submits the form.</p>
				</PanelBody>
				<PanelBody title="Label Text Settings" initialOpen={true}>
					<TextControl
						value={nameLabel}
						onChange={value => setAttributes({nameLabel: value})}
					/>	
					<TextControl
						value={subjectLabel}
						onChange={value => setAttributes({subjectLabel: value})}
					/>	
					<TextControl
					value={emailLabel}
					onChange={value => setAttributes({emailLabel: value})}
					/>		
					<TextControl
						value={messageLabel}
						onChange={value => setAttributes({messageLabel: value})}
					/>						
				</PanelBody>

			</InspectorControls>
			<InspectorControls group="styles">
				<PanelBody title="Form Settings" initialOpen={false}>
						<TextControl
							label="Label Font Size"
							value={labelFontSize}
							onChange={(value) => setAttributes({labelFontSize: value})}
							help="Set the input height (e.g., 40px, 2em, etc.)"
						/>	
						<TextControl
							label="Input Font Size"
							value={inputFontSize}
							onChange={(value) => setAttributes({inputFontSize: value})}
							help="Set the input height (e.g., 40px, 2em, etc.)"
						/>	
						<TextControl
							label="Padding"
							value={inputPadding}
							onChange={(value) => { setAttributes({inputPadding: value})}}
							help="You can set like 10px or 10px 30px"
						/>
						<TextControl
							label="Margin Top"
							value={inputMarginTop}
							onChange={value => setAttributes({inputMarginTop: value})}
							help="Set the input height (e.g., 40px, 2em, etc.)"
						/>
						<TextControl
							label="Gap"
							value={inputGap}
							onChange={handleInputGap}
							help="Set the input height (e.g., 40px, 2em, etc.)"
						/>
						<TextControl
							label="Textarea min height"
							value={textareaHeight}
							onChange={value => setAttributes({textareaHeight: value})}
							help="Set the input height (e.g., 40px, 2em, etc.)"
						/>
				</PanelBody>
				<PanelBody title="Button Settings" initialOpen={false}>
					<TextControl
						label="Font Size"
						value={textareaHeight}
						onChange={value => setAttributes({textareaHeight: value})}
						help="Set the input height (e.g., 40px, 2em, etc.)"
					/>
					<TextControl
						label="Padding"
						value={textareaHeight}
						onChange={value => setAttributes({textareaHeight: value})}
						help="Set the input height (e.g., 40px, 2em, etc.)"
					/>
					<TextControl
						label="Color"
						value={textareaHeight}
						onChange={value => setAttributes({textareaHeight: value})}
						help="Set the input height (e.g., 40px, 2em, etc.)"
					/>
					<TextControl
						label="Background"
						value={textareaHeight}
						onChange={value => setAttributes({textareaHeight: value})}
						help="Set the input height (e.g., 40px, 2em, etc.)"
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps() }>
				<form action="">
					<ul>
						<li style={{gap: inputGap}} >
							<label style={{fontSize: labelFontSize}} htmlFor="yourname" >{nameLabel}</label>
							<input style={{height: "", fontSize: inputFontSize, padding: inputPadding}} value={name} onChange={(event) => {setName(event.target.value)}} type="text" id='yourname' name="yourname" />
						</li>
						<li style={{gap: inputGap, marginTop: inputMarginTop }} >
							<label style={{fontSize: labelFontSize}}  htmlFor="yourname">{subjectLabel}</label>
							<input style={{height: "", fontSize: inputFontSize, padding: inputPadding}} value={subject} onChange={(event) => {setSubject(event.target.value)}} type="text" id='yourname' name="yourname" />
						</li>
						<li style={{gap: inputGap, marginTop: inputMarginTop }} >
							<label style={{fontSize: labelFontSize}} htmlFor="youremail">{emailLabel}</label>
							<input style={{height: "", fontSize: inputFontSize, padding: inputPadding}} value={email} onChange={(event) => {setEmail(event.target.value)}} type="text" id='youremail' name="youremail" />
						</li>
						<li style={{gap: inputGap, marginTop: inputMarginTop,  }} >
							<label style={{fontSize: labelFontSize}} htmlFor="yourmessage">{messageLabel}</label>
							<textarea 
							style={{fontSize: inputFontSize, padding: inputPadding, minHeight: textareaHeight}}
							value={message}
							onChange={(event) => {setMessage(event.target.value)}}							
							></textarea>
						</li>
						<li>
							<button className='submitBtn'>Submit</button>
						</li>
					</ul>
				</form>
			</div>
		</>
	);
}

